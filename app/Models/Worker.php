<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $table = 'workers';

    protected $fillable = [
        'name','last_name','father_name','post_id','phone','email','passport','regaddress','address_id'
    ];

    public function post(){
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
    public function address(){
        return $this->belongsTo(Address::class, 'address_id', 'id');
    }
    public function regaddress(){
        return $this->belongsTo(Address::class, 'regaddress', 'id');
    }
}
