<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalPersonnel extends Model
{
    use HasFactory;

    protected $table = "external_personnels";

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'contact_number',
        'affiliation',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function assignedGroups()
    {
        return $this->hasMany(GroupAssignment::class, 'personnel_id');
    }
    
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function fullName()
    {
        return "{$this->first_name} {$this->middle_name} {$this->last_name}";
    }
}
