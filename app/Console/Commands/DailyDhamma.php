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
        $dhamma_today = $list_question_answer[rand(11601, 11637)];
        $database->getReference('/dhamma-today/')->set($dhamma_today);
    }
}
