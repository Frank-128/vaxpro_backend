<?php

use App\Jobs\VaccinationPromotionJob;
use App\Jobs\VaccinationReminderJob;
use Illuminate\Support\Facades\Schedule;



// To be uncommented there are no sms currently available;

// Schedule::job(VaccinationReminderJob::class)->dailyAt('08:00'); 



// Schedule::job(VaccinationPromotionJob::class)->weeklyOn(1, '08:00'); 
// Schedule::job(VaccinationPromotionJob::class)->weeklyOn(3, '08:00'); 
// Schedule::job(VaccinationPromotionJob::class)->weeklyOn(5, '08:00'); 


