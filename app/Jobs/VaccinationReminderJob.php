<?php

namespace App\Jobs;

use App\Models\ChildVaccinationSchedule;
use App\Models\User;
use App\Services\SmsService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class VaccinationReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $smsService;
    public function __construct(SmsService $smsService)
    {
        //
        $this->smsService = $smsService;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $threeDaysAgo = Carbon::now()->subDays(3)->format('Y-m-d');
        $threeDaysFromNow = Carbon::now()->addDays(3)->format('Y-m-d');

        $childrenVaccinationScheduleDelayed = ChildVaccinationSchedule::whereDate('next_vaccination_date', $threeDaysAgo)->with('child')->where('status', 0)->get();
        $childrenVaccinationScheduleToCome = ChildVaccinationSchedule::whereDate('next_vaccination_date', $threeDaysFromNow)->with('child')->where('status', 0)->get();

        if ($childrenVaccinationScheduleDelayed) {
            foreach ($childrenVaccinationScheduleDelayed as $child) {
                $postData = [

                    'message' => 'Ndugu mzazi unakumbushwa kua umepitiliza muda wa kufika katika kituo cha kutoa huduma ya chanjo kwa ajili ya mtoto wako ' . $child->child->firstname . " " . $child->child->middlename . " " . $child->child->surname,

                    'recipient' => $child->child->parents_guardians->first()->user->contacts

                ];

                $communityWorker = User::whereHas('role',function($query){
                    $query->where('account_type','community_health_worker');
                })->where('ward_id', $child->ward_id)->inRandomOrder()->first();

                $postDataCommunity = [

                    'message' => 'Mzazi wa mtoto ' . $child->child->firstname . " " . $child->child->middlename . " " . $child->child->surname . ' hakufika katika kituo cha huduma ya afya '.$child->facilities->facility_name.' ' .$child->facilities->facility_reg_no.' kwa ajili ya chanjo. Tafadhali wasiliana nae kupitia nambari ya simu ' . $child->child->parents_guardians->first()->user->contacts . ' kwa ajili ya taarifa zaidi',
                    'recipient' => '255714179152'

                ];
                Log::info("This is the post message sent", [$postDataCommunity]);
                $this->smsService->sms_oasis($postDataCommunity);

                Log::info("This is the post message sent", [$postData]);
                $this->smsService->sms_oasis($postData);
                if ($communityWorker) {
                    $postDataCommunity = [

                        'message' => 'Mzazi wa mtoto ' . $child->child->firstname . " " . $child->child->middlename . " " . $child->child->surname ." mwenye kadi namba". $child->child->card_no .' hakufika katika kituo cha huduma ya afya '.$child->facilities->facility_name.' ' .$child->facilities->facility_reg_no.' kwa ajili ya chanjo. Tafadhali wasiliana nae kupitia nambari ya simu ' . $child->child->parents_guardians->first()->user->contacts . ' kwa ajili ya taarifa zaidi',
                        'recipient' => $communityWorker->contacts

                    ];
                    Log::info("This is the post message sent", [$postDataCommunity]);
                    $this->smsService->sms_oasis($postDataCommunity);
                }
            }
        }

        if ($childrenVaccinationScheduleToCome) {
            foreach ($childrenVaccinationScheduleToCome as $child) {
                $postData = [

                    'message' => 'Ndugu mzazi unakumbushwa kufika katika kituo cha kutoa huduma ya chanjo kwa ajili ya mtoto wako ' . $child->child->firstname . " " . $child->child->middlename . " " . $child->child->surname . " mnamo tarehe" . $child->next_vaccination_date,

                    'recipient' => $child->child->parents_guardians->first()->user->contacts

                ];
                Log::info("This is the post message sent", [$postData['message']]);
                $this->smsService->sms_oasis($postData);
            }
        }
    }
}
