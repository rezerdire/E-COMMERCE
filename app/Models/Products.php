<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'brand_id','description', 'slug', 'price', 'stock', 'image', 'is_active'];

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
    

        public function Brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function Orders()
    {
        return $this->belongsToMany(Orders::class);
    }
}
