<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class StockLog extends Model
{
    protected $table = 'logs_stock';
    protected $fillable = [
        'user_id',
        'stock_id',
        'action',
        'data_before',
        'data_after',
        'created_at'
    ];

    public function stock()
    {
        return $this->belongsTo(Stocks::class);
    }

}
