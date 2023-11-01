<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $fillable = [              
        'name',
        'price',
        'stock',
        'stand',
        'category_id',
        'desc',
        'photo',
       ];

    use HasFactory,SoftDeletes;

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function category()
    {
        return $this->belongsTo(Categorie::class);
    }
}
