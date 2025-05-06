<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'description',
        'amount',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function thesisPhase()
    {
        return $this->belongsTo(ThesisPhase::class);
    }
}
