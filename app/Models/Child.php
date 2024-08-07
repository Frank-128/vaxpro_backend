<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $primaryKey = 'card_no';
    protected $keyType = 'string';


    protected $fillable = ['card_no', 'firstname', 'middlename', 'surname', 'gender', 'facility_id', 'ward_id', 'house_no', 'date_of_birth', 'modified_by'];




    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function child_vaccination_schedules()
    {
        return $this->hasMany(ChildVaccinationSchedule::class,'child_id','card_no');
    }

    // public function child_vaccination(){
    //     return $this->belongsToMany();
    // }

    public function vaccinations()
    {
        return $this->belongsToMany(Vaccination::class, 'child_vaccinations', 'child_id', 'vaccination_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function facilities()
    {
        return $this->belongsTo(Facility::class, 'facility_id', 'facility_reg_no');
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    public function health_workers()
    {
        return $this->belongsTo(HealthWorker::class);
    }

    public function parents_guardians()
    {
        return $this->belongsToMany(ParentsGuardians::class, 'parents_guardians_children', 'card_no', 'nida_id',)->withPivot('relationship_with_child');

    }

    public function certificates()
    {
        return $this->hasOne(Certificates::class, 'child_id', 'card_no');
    }

    public function community_healthworker_feedbacks(){
        return $this->hasMany(CommunityHealthworkerFeedback::class);
    }
}
