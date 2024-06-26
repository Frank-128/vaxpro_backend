<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = ['child_id','vaccination_date','facility_id','vaccine_list','status', 'rejection_reason'];

    protected $casts = [
        'vaccine_list' => 'array',
    ];

    public static function find(string $id)
    {
    }

    public function children(){
        return $this->belongsTo(Child::class,'child_id','card_no');
    }


    public function facilities(){
        return $this->belongsTo(Facility::class, 'facility_id', 'facility_reg_no');
    }
}
