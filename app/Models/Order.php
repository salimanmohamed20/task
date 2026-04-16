<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'quantity',
        'price',
        'status',
    ];

    protected $casts = [
        'price'    => 'decimal:2',
        'quantity' => 'integer',
    ];

    /**
     * Possible statuses for an order.
     */
    const STATUS_PENDING   = 'pending';
    const STATUS_PROCESSED = 'processed';
    const STATUS_FAILED    = 'failed';
}
