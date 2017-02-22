<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\V3\Firebase;

class QuestionAnswerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $firebase = Firebase::fromServiceAccount(storage_path().'/google-service-account.json');
        $database = $firebase->getDatabase();

        $list_question_answer = $database->getReference('/question-answer')->getSnapshot()->getValue();

        return view('question-answer.index')->with('list_question_answer', $list_question_answer);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('question-answer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $firebase = Firebase::fromServiceAccount(storage_path().'/google-service-account.json');
        $database = $firebase->getDatabase();

        $question_answer = [
            'title' => $request->get('title'),
            'question' => $request->get('question'),
            'answer' => $request->get('answer')
        ];

        $database->getReference('/question-answer')->push($question_answer);

        session(['notify' => 'add article success']);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $firebase = Firebase::fromServiceAccount(storage_path().'/google-service-account.json');
        $database = $firebase->getDatabase();
        $reference = $database->getReference('/question-answer/'.$id);
        $question_answer = $reference->getSnapshot()->getValue();

        return view('question-answer.edit')
            ->with('question_answer', $question_answer)
            ->with('id', $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $firebase = Firebase::fromServiceAccount(storage_path().'/google-service-account.json');
        $database = $firebase->getDatabase();

        $question_answer = [
            'title' => $request->get('title'),
            'question' => $request->get('question'),
            'answer' => $request->get('answer')
        ];

        $database->getReference('/question-answer/'.$id)->set($question_answer);

        session(['notify' => 'update article success']);

        return redirect('question-answer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $firebase = Firebase::fromServiceAccount(storage_path().'/google-service-account.json');
        $database = $firebase->getDatabase();
        $database->getReference('/question-answer/'.$id)->remove();

        session(['notify' => 'delete article success']);

        return redirect('question-answer');
    }
}
