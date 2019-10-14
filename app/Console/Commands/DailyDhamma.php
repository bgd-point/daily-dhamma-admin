<?php

namespace App\Console\Commands;

use Firebase\V3\Firebase;
use Illuminate\Console\Command;

class DailyDhamma extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily-dhamma:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate dhamma for today';

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

        $firebase = Firebase::fromServiceAccount(storage_path().'/google-service-account.json');
        $database = $firebase->getDatabase();
        $list_question_answer = $database->getReference('/question-answer')->getSnapshot()->getValue();
        $list_question_answer_en = $database->getReference('/question-answer-en')->getSnapshot()->getValue();
        $array = [10100, 10200, 11600, 11900];
        $dhamma_today = $list_question_answer[$array[rand(0, 3)] + rand(1, 50)];
        $dhamma_today_en = $list_question_answer_en[$array[rand(0, 3)] + rand(1, 50)];
        $database->getReference('/dhamma-today/')->set($dhamma_today);
        $database->getReference('/dhamma-today-en/')->set($dhamma_today_en);
    }
}
