<?php

namespace Indianic\CountryStateCityManagement\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model {

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function city() {
        return $this->hasMany(City::class);
    }

}
