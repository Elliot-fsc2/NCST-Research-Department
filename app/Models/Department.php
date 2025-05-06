<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
    ];

    public function courses(){
        return $this->hasMany(Course::class);
    }

    public function professors(){
        return $this->hasMany(User::class, 'department_id')->where('role','professor');
    }

    public function students(){
        return $this->hasMany(User::class, 'department_id')->where('role','student');
    }

}
