<?php

namespace Indianic\CountryStateCityManagement\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    // use HasFactory;
    public $timestamps = false;
    public function State()
    {
        return $this->hasMany(State::class);
    }
}
