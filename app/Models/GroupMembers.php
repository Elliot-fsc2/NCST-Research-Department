<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMembers extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'student_id',
        'is_leader',
        'contact_number',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'student_id')->where('is_leader', 1);
    }

    public static function getGroupLeader($groupId)
    {
        return self::where('group_id', $groupId)
            ->where('is_leader', true)
            ->with('student')
            ->first();
    }
}
