<?php

namespace Indianic\CountryStateCityManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model {

    use HasFactory;

    public $timestamps = false;

    public function Country() {
        return $this->belongsTo(Country::class);
    }

    public function city() {
        return $this->hasMany(City::class);
    }

}
