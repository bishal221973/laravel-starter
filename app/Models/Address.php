<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $guarded=['id'];

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function province(){
        return $this->belongsTo(Province::class);
    }
    public function district(){
        return $this->belongsTo(District::class);
    }

    public function municipality(){
        return $this->belongsTo(Municipality::class);
    }
}
