<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['uid', 'role_id', 'district_id', 'region_id', 'ward_id', 'password', 'facility_id', 'contacts', 'modified_by'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password',

    ];

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function facilities()
    {
        return $this->belongsTo(Facility::class, 'facility_id', 'facility_reg_no');
    }

    public function health_workers()
    {
        return $this->hasMany(HealthWorker::class);
    }

    public function modified_by()
    {
        return $this->hasMany(Facility::class);
    }


    //user who adds the facility

    public function role()
    {
        return $this->belongsTo(Role::class, "role_id");
    }

    public function parents_guardians()
    {
        return $this->hasMany(ParentsGuardians::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [

            'password' => 'hashed',];
    }
}
