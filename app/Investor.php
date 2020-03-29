<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    protected $fillable = ['email','investor_name', 'investor_type'];

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }
}
