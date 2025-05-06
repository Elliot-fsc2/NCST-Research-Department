<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    protected $fillable = [
        'name',
        'is_active',
    ];

    public function activeThesisPhase()
    {
        return $this->hasOne(ThesisPhase::class)->where('is_active', true);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function thesisFees()
    {
        return $this->hasMany(ThesisFee::class);
    }

    public function isActive(){
        return $this->is_active;
    }
}
