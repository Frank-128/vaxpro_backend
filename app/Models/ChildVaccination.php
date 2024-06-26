<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildVaccination extends Model
{
    use HasFactory;
    protected $fillable = ['child_id','vaccination_id','is_active'];

    
    public function child_vaccination_schedules(){
        return $this->hasMany(ChildVaccinationSchedule::class);
    }
    
    public function vaccinations(){
        return $this->hasMany(Vaccination::class,'id','vaccination_id');
    }
}
