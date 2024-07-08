<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;

    protected $table = 'manufacturers';

    protected $fillable = [
        'name','boss','boss_last_name','boss_father_name','address_id','phone','email','inn'
    ];

    public function address(){
        return $this->belongsTo(Address::class, 'address_id', 'id');
    }
}
