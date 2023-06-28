<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AllKycCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'allkyc:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   
        date_default_timezone_set("Asia/Kolkata");
        $hour = date('H');
        
        if($hour<22 && $hour>=9){
            
            if($hour==00){
                $phour=23;
                $date=date('Y-m-d', strtotime('-1 day'));
            }
            else{
                $phour=$hour-1;
                $date=date('Y-m-d');
            }
            
            //Samsung Kyc
            $skdata1=\DB::connection('mysql2')->table('kyc_event_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%Samsung-Offline%')->where('Event_Name','=','Key Generation Success')->where('Created_At','>=',$date.' '.$phour.':00:00')->where('Created_At','<=',$date.' '.$phour.':59:59')->get();
            
            $skdata2=\DB::connection('mysql2')->table('kyc_event_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%Samsung-Offline%')->where('Event_Name','=','Digilocker Window Open')->where('Created_At','>=',$date.' '.$phour.':00:00')->where('Created_At','<=',$date.' '.$phour.':59:59')->get();

            $skdata3=\DB::connection('mysql2')->table('kyc_event_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%Samsung-Offline%')->where('Event_Name','=','Dmi-Ekyc_Window_Close')->where('Created_At','>=',$date.' '.$phour.':00:00')->where('Created_At','<=',$date.' '.$phour.':59:59')->get();

            $skdata4=\DB::connection('mysql2')->table('kyc_event_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%Samsung-Offline%')->where('Event_Name','=','Accept_Button_Click')->where('Created_At','>=',$date.' '.$phour.':00:00')->where('Created_At','<=',$date.' '.$phour.':59:59')->get();

            $skdata5=\DB::connection('mysql2')->table('kyc_event_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%Samsung-Offline%')->where('Event_Name','=','Kyc Selfie Upload')->where('Created_At','>=',$date.' '.$phour.':00:00')->where('Created_At','<=',$date.' '.$phour.':59:59')->get();

            $skdata6=\DB::connection('mysql2')->table('kyc_event_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%Samsung-Offline%')->where('Event_Name','like','%SFDC Upload data%')->where('Remark_1','like','%success%')->where('Created_At','>=',$date.' '.$phour.':00:00')->where('Created_At','<=',$date.' '.$phour.':59:59')->get();

            $skvalue1=json_encode($skdata1[0]);
            $skvalue2=json_encode($skdata2[0]);
            $skvalue3=json_encode($skdata3[0]);
            $skvalue4=json_encode($skdata4[0]);
            $skvalue5=json_encode($skdata5[0]);
            $skvalue6=json_encode($skdata6[0]);

            //Samsung Emandate
            $sedata1=\DB::connection('mysql5')->table('emandate_events_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%SAMSUNG%')->where('Event_Name','=','E-mandate Page')->where('Time_Stamp','>=',$date.' '.$phour.':00:00')->where('Time_Stamp','<=',$date.' '.$phour.':59:59')->get();
            
            $sedata2=\DB::connection('mysql5')->table('emandate_events_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%SAMSUNG%')->where('Event_Name','=','Next RZP')->where('Time_Stamp','>=',$date.' '.$phour.':00:00')->where('Time_Stamp','<=',$date.' '.$phour.':59:59')->get();

            $sedata3=\DB::connection('mysql5')->table('emandate_events_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%SAMSUNG%')->where('Event_Name','like','%SFDC NACH Update Success%')->where('Time_Stamp','>=',$date.' '.$phour.':00:00')->where('Time_Stamp','<=',$date.' '.$phour.':59:59')->get();

            $sevalue1=json_encode($sedata1[0]);
            $sevalue2=json_encode($sedata2[0]);
            $sevalue3=json_encode($sedata3[0]);

            //Gpay Kyc
            $gkdata1=\DB::connection('mysql2')->table('kyc_event_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%GPay%')->where('Event_Name','=','Key Generation Success')->where('Created_At','>=',$date.' '.$phour.':00:00')->where('Created_At','<=',$date.' '.$phour.':59:59')->get();
            
            $gkdata2=\DB::connection('mysql2')->table('kyc_event_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%GPay%')->where('Event_Name','=','Kyc Selfie Upload')->where('Created_At','>=',$date.' '.$phour.':00:00')->where('Created_At','<=',$date.' '.$phour.':59:59')->get();
            
            $gkdata3=\DB::connection('mysql2')->table('kyc_event_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%GPay%')->where('Event_Name','=','Digilocker Master')->where('Created_At','>=',$date.' '.$phour.':00:00')->where('Created_At','<=',$date.' '.$phour.':59:59')->get();

            $gkdata4=\DB::connection('mysql2')->table('kyc_event_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%GPay%')->where('Event_Name','like','%SFDC Upload data%')->where('Remark_1','like','%success%')->where('Created_At','>=',$date.' '.$phour.':00:00')->where('Created_At','<=',$date.' '.$phour.':59:59')->get();

            $gkvalue1=json_encode($gkdata1[0]);
            $gkvalue2=json_encode($gkdata2[0]);
            $gkvalue3=json_encode($gkdata3[0]);
            $gkvalue4=json_encode($gkdata4[0]);

            //Gpay Emandate
            $gedata1=\DB::connection('mysql3')->table('emandate_events_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%GPay%')->where('Event_Name','=','E-mandate Page')->where('Time_Stamp','>=',$date.' '.$phour.':00:00')->where('Time_Stamp','<=',$date.' '.$phour.':59:59')->get();
            
            $gedata2=\DB::connection('mysql3')->table('emandate_events_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%GPay%')->where('Event_Name','=','Next RZP')->where('Time_Stamp','>=',$date.' '.$phour.':00:00')->where('Time_Stamp','<=',$date.' '.$phour.':59:59')->get();

            $gedata3=\DB::connection('mysql3')->table('emandate_events_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%GPay%')->where('Event_Name','like','%SFDC NACH Update Success%')->where('Time_Stamp','>=',$date.' '.$phour.':00:00')->where('Time_Stamp','<=',$date.' '.$phour.':59:59')->get();

            $gevalue1=json_encode($gedata1[0]);
            $gevalue2=json_encode($gedata2[0]);
            $gevalue3=json_encode($gedata3[0]);

            //Reliance Kyc
            $rkdata1=\DB::connection('mysql4')->table('kyc_event_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%Reliance%')->where('Event_Name','=','Key Generation Success')->where('Created_At','>=',$date.' '.$phour.':00:00')->where('Created_At','<=',$date.' '.$phour.':59:59')->get();
            
            $rkdata2=\DB::connection('mysql4')->table('kyc_event_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%Reliance%')->where('Event_Name','=','Digilocker Window Open')->where('Created_At','>=',$date.' '.$phour.':00:00')->where('Created_At','<=',$date.' '.$phour.':59:59')->get();

            $rkdata3=\DB::connection('mysql4')->table('kyc_event_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%Reliance%')->where('Event_Name','=','Dmi-Ekyc_Window_Close')->where('Created_At','>=',$date.' '.$phour.':00:00')->where('Created_At','<=',$date.' '.$phour.':59:59')->get();

            $rkdata4=\DB::connection('mysql4')->table('kyc_event_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%Reliance%')->where('Event_Name','=','Accept_Button_Click')->where('Created_At','>=',$date.' '.$phour.':00:00')->where('Created_At','<=',$date.' '.$phour.':59:59')->get();

            $rkdata5=\DB::connection('mysql4')->table('kyc_event_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%Reliance%')->where('Event_Name','=','Kyc Selfie Upload')->where('Created_At','>=',$date.' '.$phour.':00:00')->where('Created_At','<=',$date.' '.$phour.':59:59')->get();

            $rkdata6=\DB::connection('mysql4')->table('kyc_event_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%Reliance%')->where('Event_Name','like','%SFDC Upload data%')->where('Remark_1','like','%success%')->where('Created_At','>=',$date.' '.$phour.':00:00')->where('Created_At','<=',$date.' '.$phour.':59:59')->get();

            $rkvalue1=json_encode($rkdata1[0]);
            $rkvalue2=json_encode($rkdata2[0]);
            $rkvalue3=json_encode($rkdata3[0]);
            $rkvalue4=json_encode($rkdata4[0]);
            $rkvalue5=json_encode($rkdata5[0]);
            $rkvalue6=json_encode($rkdata6[0]);

            //Reliance EMandate
            $redata1=\DB::connection('mysql5')->table('emandate_events_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%Reliance%')->where('Event_Name','=','E-mandate Page')->where('Time_Stamp','>=',$date.' '.$phour.':00:00')->where('Time_Stamp','<=',$date.' '.$phour.':59:59')->get();
            
            $redata2=\DB::connection('mysql5')->table('emandate_events_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%Reliance%')->where('Event_Name','=','Next RZP')->where('Time_Stamp','>=',$date.' '.$phour.':00:00')->where('Time_Stamp','<=',$date.' '.$phour.':59:59')->get();

            $redata3=\DB::connection('mysql5')->table('emandate_events_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%Reliance%')->where('Event_Name','like','%SFDC NACH Update Success%')->where('Time_Stamp','>=',$date.' '.$phour.':00:00')->where('Time_Stamp','<=',$date.' '.$phour.':59:59')->get();

            $revalue1=json_encode($redata1[0]);
            $revalue2=json_encode($redata2[0]);
            $revalue3=json_encode($redata3[0]);

            //Airtel KYC
            $akdata1=\DB::connection('mysql4')->table('kyc_event_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%Airtel%')->where('Event_Name','=','Key Generation Success')->where('Created_At','>=',$date.' '.$phour.':00:00')->where('Created_At','<=',$date.' '.$phour.':59:59')->get();
            
            $akdata2=\DB::connection('mysql4')->table('kyc_event_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%Airtel%')->where('Event_Name','=','Digilocker Master')->where('Created_At','>=',$date.' '.$phour.':00:00')->where('Created_At','<=',$date.' '.$phour.':59:59')->get();

            $akdata3=\DB::connection('mysql4')->table('kyc_event_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%Airtel%')->where('Event_Name','=','Digilocker Upload xml files to image')->where('Created_At','>=',$date.' '.$phour.':00:00')->where('Created_At','<=',$date.' '.$phour.':59:59')->get();

            $akdata4=\DB::connection('mysql4')->table('kyc_event_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%Airtel%')->where('Event_Name','like','%SFDC Upload data%')->where('Remark_1','like','%success%')->where('Created_At','>=',$date.' '.$phour.':00:00')->where('Created_At','<=',$date.' '.$phour.':59:59')->get();

            $akvalue1=json_encode($akdata1[0]);
            $akvalue2=json_encode($akdata2[0]);
            $akvalue3=json_encode($akdata3[0]);
            $akvalue4=json_encode($akdata4[0]);

            //Airtel Emandate
            $aedata1=\DB::connection('mysql5')->table('emandate_events_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%Airtel%')->where('Event_Name','=','E-mandate Page')->where('Time_Stamp','>=',$date.' '.$phour.':00:00')->where('Time_Stamp','<=',$date.' '.$phour.':59:59')->get();
            
            $aedata2=\DB::connection('mysql5')->table('emandate_events_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%Airtel%')->where('Event_Name','=','Next RZP')->where('Time_Stamp','>=',$date.' '.$phour.':00:00')->where('Time_Stamp','<=',$date.' '.$phour.':59:59')->get();

            $aedata3=\DB::connection('mysql5')->table('emandate_events_tracking')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('Partner_Name','like','%Airtel%')->where('Event_Name','like','%SFDC NACH Update Success%')->where('Time_Stamp','>=',$date.' '.$phour.':00:00')->where('Time_Stamp','<=',$date.' '.$phour.':59:59')->get();

            $aevalue1=json_encode($aedata1[0]);
            $aevalue2=json_encode($aedata2[0]);
            $aevalue3=json_encode($aedata3[0]);

            //LDS Report 
            $text='';
            if($hour==13)
            {   
                $Gpay='GPay';
                $Reliance='Reliance';
                $R2V2='R2V2';
                $Airtel='Airtel';
                $lds='LDS Report<br>07AM-13PM<br>';
                $lg=\DB::connection('mysql10')->table('events')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('remark_1','like','%GPay%')->where('time_stamp','>=',$date.' 07:00:00')->where('time_stamp','<=',$date.' 12:59:59')->get();

                $lr=\DB::connection('mysql10')->table('events')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('remark_1','like','%Reliance%')->where('time_stamp','>=',$date.' 07:00:00')->where('time_stamp','<=',$date.' 12:59:59')->get();

                $lrv=\DB::connection('mysql10')->table('events')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('remark_1','like','%R2V2-LoS%')->where('time_stamp','>=',$date.' 07:00:00')->where('time_stamp','<=',$date.' 12:59:59')->get();

                $la=\DB::connection('mysql10')->table('events')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('remark_1','like','%Airtel%')->where('time_stamp','>=',$date.' 07:00:00')->where('time_stamp','<=',$date.' 12:59:59')->get();

                $text='<strong>'.
                $lds.'</strong><b>Partner. . . . . . . . Count</b><br>1. '.
                $Gpay.'. . . . . . . . . .'.$lg[0]->Count.'<br>2. '.
                $Reliance.'. . . . . . .'.$lr[0]->Count.'<br>3. '.
                $R2V2.'. . . . . . . . . .'.$lrv[0]->Count.'<br>4. '.
                $Airtel.'. . . . . . . . . .'.$la[0]->Count.'<br>';
            }
            elseif($hour==19)
            {   
                $Gpay='GPay';
                $Reliance='Reliance';
                $R2V2='R2V2';
                $Airtel='Airtel';
                $lds='LDS Report<br>13PM-19PM<br>';
                $lg=\DB::connection('mysql10')->table('events')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('remark_1','like','%GPay%')->where('time_stamp','>=',$date.' 13:00:00')->where('time_stamp','<=',$date.' 18:59:59')->get();

                $lr=\DB::connection('mysql10')->table('events')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('remark_1','like','%Reliance%')->where('time_stamp','>=',$date.' 13:00:00')->where('time_stamp','<=',$date.' 18:59:59')->get();

                $lrv=\DB::connection('mysql10')->table('events')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('remark_1','like','%R2V2-LoS%')->where('time_stamp','>=',$date.' 13:00:00')->where('time_stamp','<=',$date.' 18:59:59')->get();

                $la=\DB::connection('mysql10')->table('events')->select(\DB::raw('COUNT(distinct Mobile) as Count'))->where('remark_1','like','%Airtel%')->where('time_stamp','>=',$date.' 13:00:00')->where('time_stamp','<=',$date.' 18:59:59')->get();

                $text='<strong>'.
                $lds.'</strong><b>Partner. . . . . . . . Count</b><br>1. '.
                $Gpay.'. . . . . . . . . .'.$lg[0]->Count.'<br>2. '.
                $Reliance.'. . . . . . .'.$lr[0]->Count.'<br>3. '.
                $R2V2.'. . . . . . . . . .'.$lrv[0]->Count.'<br>4. '.
                $Airtel.'. . . . . . . . . .'.$la[0]->Count.'<br>';
            }
            
            $a='';
            if($hour<12){
                $am='AM';
            }
            else{
                $am='PM';
            }
            if($phour<12)
            {
                $pm='AM';
                if($phour<10){
                    $a='0';
                }
            }
            else{
                $pm='PM';
            }
            
            $payload =['flockml' => '<flockml><strong><i>Samsung KYC<br>'.$a.$phour.$pm.'-'.$hour.$am.'</i></strong><br>
            <b>Event-Name . . . . . . . . . .Count</b><br>
            1. Key Generation . . . . . . .'.json_decode($skvalue1)->Count.'<br>
            2. Accept Click . . . . . . . . . '.json_decode($skvalue4)->Count.'<br>
            3. Selfie Upload . . .  . . . . . .'.json_decode($skvalue5)->Count.'<br>
            4. SFDC Upload . . . . . . . .  .'.json_decode($skvalue6)->Count.'<br><br>
            <strong><i>Samsung Emandate<br> '.$a.$phour.$pm.'-'.$hour.$am.'</i></strong><br>
            <b>Event-Name . . . . . . . . . .Count</b><br>
            1. Emandate Initiated . . . .'.json_decode($sevalue1)->Count.'<br>
            2. Next RZP. . . . . . . . . . . . .'.json_decode($sevalue2)->Count.'<br>
            3. Nach Object Created. . .'.json_decode($sevalue3)->Count.'<br><br>
            <strong><i>GPay KYC<br> '.$a.$phour.$pm.'-'.$hour.$am.'</i></strong><br>
            <b>Event-Name . . . . . . . . . .Count</b><br>
            1. Key Generation . . . . . . .'.json_decode($gkvalue1)->Count.'<br>
            2. Selfie Upload . . .  . . . . . .'.json_decode($gkvalue2)->Count.'<br>
            3. Digilocker Open . . . . . . '.json_decode($gkvalue3)->Count.'<br>
            4. SFDC Upload . . . . . . . .  .'.json_decode($gkvalue4)->Count.'<br><br>
            <strong><i>GPay Emandate <br> '.$a.$phour.$pm.'-'.$hour.$am.'</i></strong><br>
            <b>Event-Name . . . . . . . . . .Count</b><br>
            1. Emandate Initiated . . . .'.json_decode($gevalue1)->Count.'<br>
            2. Next RZP. . . . . . . . . . . . .'.json_decode($gevalue2)->Count.'<br>
            3. Nach Object Created. . .'.json_decode($gevalue3)->Count.'<br><br>
            <strong><i>Airtel KYC<br> '.$a.$phour.$pm.'-'.$hour.$am.'</i></strong><br>
            <b>Event-Name . . . . . . . . . .Count</b><br>
            1. Key Generation . . . . . . .'.json_decode($akvalue1)->Count.'<br>
            2. Digilocker Open . . . . . . '.json_decode($akvalue2)->Count.'<br>
            3. Digilocker Close . . . . . . '.json_decode($akvalue3)->Count.'<br>
            4. SFDC Upload . . . . . . . .  .'.json_decode($akvalue4)->Count.'<br><br>
            <strong><i>Airtel Emandate <br> '.$a.$phour.$pm.'-'.$hour.$am.'</i></strong><br>
            <b>Event-Name . . . . . . . . . .Count</b><br>
            1. Emandate Initiated . . . .'.json_decode($aevalue1)->Count.'<br>
            2. Next RZP. . . . . . . . . . . . .'.json_decode($aevalue2)->Count.'<br>
            3. Nach Object Created. . .'.json_decode($aevalue3)->Count.'<br><br>'
            .$text.
            '<b>....................<i>END</i>....................<b></flockml>'];
            $curl = curl_init();
            curl_setopt_array($curl, array(
                // CURLOPT_URL => 'https://api.flock.com/hooks/sendMessage/a77fccfd-7dfc-4baa-b9bf-f818e3ba8fb4',
                CURLOPT_URL => 'https://api.flock.com/hooks/sendMessage/909c6b59-000e-43c8-bc2a-2c73c5b002cc',

                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>json_encode($payload)
                    ,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                    ),
                ));
                    
                $response = curl_exec($curl);
                curl_close($curl);
        }

        return 0;
    }
}
