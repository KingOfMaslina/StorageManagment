<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentFull extends Model
{
    use HasFactory;

    protected $table = 'shipment_fulls';

    protected $fillable = [
        'shipment_id','product_id','quantity'
    ];

    public function shipment(){
        return $this->belongsTo(Shipment::class, 'shipment_id', 'id');
    }
    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
