<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThesisPhase extends Model
{
    protected $fillable = [
        'name',
        'school_year_id',
        'is_active',
    ];

    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function isActive(){
        return $this->is_active;
    }
}
