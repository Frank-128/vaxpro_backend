<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = ['facility_reg_no','facility_name','contacts','ward_id',];
    protected $primaryKey = 'facility_reg_no';
    public  $incrementing = false;


    public function bookings(){
        return $this->hasMany(Booking::class, 'facility_id', 'facility_reg_no');
    }
    public function child_vaccination_schedules(){
        return $this->hasMany(ChildVaccinationSchedule::class);

    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function health_workers(){
        return $this->hasMany(HealthWorker::class,null,'staff_id');
    }

    public function child(){
        return $this->hasMany(Child::class,null,'card_no');
    }


    public function ward(){
        return $this->belongsTo(Ward::class);
    }

    public function community_healthworker_feedbacks(){
        return $this->hasMany(CommunityHealthworkerFeedback::class);
    }

}
