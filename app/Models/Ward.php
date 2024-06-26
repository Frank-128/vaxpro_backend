<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    protected $fillable = ['district_id','ward_name'];

    public function district(){
        return $this->belongsTo(District::class);
    }
   
    public function user(){
        return $this->hasMany(User::class);
    }

    public function parent_guardians(){
        return $this->hasMany(ParentsGuardians::class);
    }

    public function facility(){
        return $this->hasMany(Facility::class);
    }

    public function children(){
        return $this->hasMany(Child::class);
    }
}
