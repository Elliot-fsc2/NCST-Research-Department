<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'name',
        'professor_id',
        'course_id'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function professor()
    {
        return $this->belongsTo(User::class, 'professor_id');
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'section_user');
    }

    public function groupCount()
    {
        return $this->groups()->count();
    }


}
