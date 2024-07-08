<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'customer_id','worker_id','order_date','entry_date','status_id'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function worker(){
        return $this->belongsTo(Worker::class, 'worker_id', 'id');
    }
    public function status(){
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
}
