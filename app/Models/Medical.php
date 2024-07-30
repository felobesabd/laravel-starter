<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medical extends Model
{
    protected $table = "medical";
    protected $fillable= ['pdf', 'patient_id'];
    public $timestamps = false;
}
