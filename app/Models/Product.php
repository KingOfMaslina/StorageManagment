<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name','category_id','articul','price','manufacturer_id','unit','quantity','image'
    ];

    public function manufacturer(){
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id', 'id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
