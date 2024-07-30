<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = "patient";
    protected $fillable= ['name', 'age'];
    public $timestamps = false;

    public function doctor()
    {
        return $this->hasManyThrough(
            'App\Models\Doctor',
            'App\Models\Medical',
            'patient_id',
            'medical_id',
            'id',
            'id'
        );
    }

}
