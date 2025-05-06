<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
      'title',  
      'is_approved',  
      'section_id',
      'thesis_phase_id',  
      'school_year_id',  
      'title_defense_date',  
      'final_defense_date',  
    ];

    protected $casts = [
        'title_defense_date' => 'date',
        'final_defense_date' => 'date',
    ];

    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class, 'school_year_id','id');
    }

    public function thesisPhase()
    {
        return $this->belongsTo(ThesisPhase::class, 'thesis_phase_id','id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function groupAssignments()
    {
        return $this->hasMany(GroupAssignment::class);
    }

    public function thesisAdvisers()
    {
    }
    public function groupMembers()
    {
        return $this->hasMany(GroupMembers::class, 'group_id');
    }

    public function leader()
    {
        return $this->hasOne(GroupMembers::class, 'group_id')->where('is_leader', true);
    }

    public function finalDefenseDate()
    {
        return Carbon::parse($this->final_defense_date)->format('F d, Y');
    }
}
