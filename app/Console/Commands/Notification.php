<?php

namespace App\Console\Commands;

use Firebase\V3\Firebase;
use Illuminate\Console\Command;

class Notification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'push-notification:message {message}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Push notification using firebase cloud messaging';

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
     * @return mixed
     */
    public function handle()
    {
        // API access key from Google API's Console
        define('API_ACCESS_KEY', env('FIREBASE_WEB_API'));

        // Device token, limit max 1000
        $firebase = Firebase::fromServiceAccount(storage_path().'/google-service-account.json');
        $database = $firebase->getDatabase();

        $hour = date('H');
        $tokens = $database->getReference('/devices/token')->orderByChild('notification_time')->equalTo('"'.$hour.':00"')->getSnapshot()->getValue();

        $registrationIds = [];
        foreach ($tokens as $key => $token) {
            array_push($registrationIds, $key);
            if (count($registrationIds) == 500) {
                self::sendNotification($this->argument('message'), $registrationIds);
                $registrationIds = [];
            }
        }

        self::sendNotification($this->argument('message'), $registrationIds);
    }

    private static function sendNotification($message, $registrationIds)
    {
        $msg =
            [
                'title'     => 'Daily Dhamma',
                'body'      => $message,
                'sound'     => 'default',
            ];

        $fields =
            [
                'registration_ids'    => $registrationIds,
                'notification'        => $msg,
                'priority'            => 'high',
            ];

        $headers =
            [
                'Authorization: key='.env('FIREBASE_SERVER_KEY'),
                'Content-Type: application/json',
            ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);

        info($result);
    }
}
