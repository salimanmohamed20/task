<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public int $tries = 3;


    public array $backoff = [10, 30, 60];


    public function __construct(public readonly Order $order)
    {

        $this->onQueue('orders_queue');
    }


    public function handle(): void
    {
        Log::info("Processing order #{$this->order->id} — product: {$this->order->product_name}");


        $this->order->update(['status' => Order::STATUS_PROCESSED]);

        Log::info("Order #{$this->order->id} successfully processed.");
    }


    public function failed(\Throwable $exception): void
    {
        Log::error(
            "Order #{$this->order->id} failed after {$this->tries} attempts. " .
            "Error: {$exception->getMessage()}"
        );

        $this->order->update(['status' => Order::STATUS_FAILED]);
    }
}
