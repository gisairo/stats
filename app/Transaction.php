<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function investor()
    {
        return $this->belongsTo('App\Investor');
    }
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
