<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'student_number',
        'role',
        'department_id',
        'course_id',
        'email',
        'password',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function fullName(): string
    {
        return trim("{$this->first_name} {$this->middle_name} {$this->last_name}");
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function handledSections() // For professors
    {
        return $this->hasMany(Section::class, 'professor_id');
    }

    public function sections() // For students
    {
        return $this->belongsToMany(Section::class, 'section_user');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_members', 'student_id', 'group_id');
    }

    public function personnel()
    {
        return $this->morphMany(GroupAssignment::class, 'personnel');
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }

    public function isProfessor()
    {
        return $this->role === 'professor';
    }

    public function isResearchHead()
    {
        return $this->role === 'head';
    }

    public function isActive()
    {
        return $this->is_active;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function groupMembers()
    {
        return $this->hasMany(GroupMembers::class, 'student_id');
    }
}
