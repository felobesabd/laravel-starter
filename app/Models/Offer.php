<?php

namespace App\Models;

use App\Scopes\OfferScope;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = "offers";
    protected $fillable = [
        'name_en', 'name_ar', 'price', 'photo', 'details_en', 'details_ar', 'status'
    ];
    protected $hidden = ['created_at', 'updated_at'];

########################################### Scopes ##############################################
########################################### El global mnh ##############################################
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new OfferScope);
    }

########################################### El local mnh ##############################################
    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }

    public function scopeInvalid($query)
    {
        return $query->where('status', 0)->whereNull('price');
    }

    // Mutators
    public function setNameEnAttribute($val)
    {
        $this->attributes['name_en'] = strtoupper($val);
    }
}
