<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Animal extends Model
{
    use HasFactory;

    /** 
     * returns a string representation of the D.O.B. attribute
     * where '01/01/2000' would present as 'Jan 1, 2000'      
     */
    public function getDOBStringAttribute() {
        return Carbon::createFromDate($this->attributes['DOB'])->toFormattedDateString();
    }

    /**
     * Calculate and return the age based on the D.O.B attribute
     */
    public function getAgeAttribute() {
        return Carbon::createFromDate($this->attributes['DOB'])->age;
    }
    
    public function isAvailable() {
        return $this->attributes['status'] === 'available';
    }

    public function requests() {
        return $this->hasMany('Models\AdoptionRequests');
    }
}
