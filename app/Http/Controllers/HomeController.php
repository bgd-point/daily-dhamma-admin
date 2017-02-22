<?php

namespace App\Http\Controllers;

use Firebase\V3\Firebase;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $firebase = Firebase::fromServiceAccount(storage_path().'/google-service-account.json');
        $database = $firebase->getDatabase();
//        $reference = $database->getReference('/');
//        $snapshot = $reference->getSnapshot();
//        $value = $snapshot->getValue();
//
//        var_dump($reference->getValue());
//        var_dump($snapshot->getKey());
//        var_dump($snapshot->getValue());
//
//        $postData = ['title' => 'hello world 2', 'body' => 'no a long text'];
//        $postRef = $database->getReference('/posts')->push($postData);
//
//        $postKey = $postRef->getKey();
//        $database->getReference('/posts/-KdVQFvuMeOee5QxkmVA')->remove();

        $posts = $database->getReference('/posts')->getSnapshot()->getValue();

        return view('home')->withPosts($posts);
    }
}
