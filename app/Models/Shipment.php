<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $table = 'shipments';

    protected $fillable = [
       'provider_id','ship_date','status_id'
    ];

    public function provider(){
        return $this->belongsTo(Provider::class, 'provider_id', 'id');
    }
    public function status(){
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
}
