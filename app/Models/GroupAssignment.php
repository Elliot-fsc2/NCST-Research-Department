<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupAssignment extends Model
{
    protected $fillable = [
        'group_id',
        'personnel_id',
        'personnel_type',
        'role_id',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function personnel()
    {
        return $this->morphTo();
    }
}
