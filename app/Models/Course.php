<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'department_id',
        'code',
        'name',
    ];

    public function sections(){
        return $this->hasMany(Section::class);
    }
    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function students(){
        return $this->hasMany(User::class, 'course_id')->where('role', 'student');
    }

    public function professor(){
        return $this->belongsTo(User::class,'course_id')->where('role','professor');
    }

}
