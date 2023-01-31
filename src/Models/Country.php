<?php

namespace Indianic\CountryStateCityManagement\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {

    public function state() {
        return $this->hasMany(State::class);
    }

}
