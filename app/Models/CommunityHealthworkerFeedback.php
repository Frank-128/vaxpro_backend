<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityHealthworkerFeedback extends Model
{
    use HasFactory;
    protected $table = 'community_healthworker_feedback';
    protected $fillable = ['child_id','facility_id','reason_for_absence'];

    public function child(){
        return $this->belongsTo(Child::class, 'child_id');
    }

    public function facility(){
        return $this->belongsTo(Facility::class, 'facility_id');
    }
}
