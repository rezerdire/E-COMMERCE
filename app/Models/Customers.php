<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{

    use HasFactory;

        protected $fillable = ['first_name', 'middle_name', 'last_name', 'email', 'phone', 'address'];

        public function orders()
    {
        return $this->hasMany(Orders::class); // One customer has many orders
    }

     public function getFullNameAttribute()
    {
        return trim("{$this->first_name} {$this->middle_name} {$this->last_name}");
    } //Concat full name

    
}
