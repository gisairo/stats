<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name'];

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }
}
