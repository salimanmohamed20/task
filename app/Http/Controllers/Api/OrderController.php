<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Jobs\ProcessOrderJob;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * POST /api/orders
     *
     * Stores a new order with status "pending" and dispatches
     * a ProcessOrderJob to the orders_queue for async processing.
     */
    public function store(StoreOrderRequest $request): JsonResponse
    {

        $order = Order::create([
            'product_name' => $request->product_name,
            'quantity'     => $request->quantity,
            'price'        => $request->price,
            'status'       => Order::STATUS_PENDING,
        ]);



        ProcessOrderJob::dispatch($order);

        return response()->json([
            'message' => 'Order created and queued for processing.',
            'order'   => new OrderResource($order),
        ], 201);
    }


    public function show(Order $order): JsonResponse
    {
        return response()->json(['order' => new OrderResource($order)]);
    }
}
