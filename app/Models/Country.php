<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
   protected $table = 'country';
    protected $fillable = [
        'countryName','countrySymbol', 'currencyCode'
    ];
    protected $primaryKey = 'countryId';
    public $timestamps = false;
    
}
