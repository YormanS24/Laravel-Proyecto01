<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'color'
    ];

    public function todos(){
        return $this->hasMany(Todo::class,'category_id','id');
    }
}
