<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdoptionRequest extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function animal() {
        return $this->belongsTo('App\Models\Animal');
    }

    public function isPending() {
        return $this->attributes['status'] == 'pending';
    }

    public function hasUpdated() {
        return $this->attributes['created_at'] != $this->attributes['updated_at'];
    }
}
