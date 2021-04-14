<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Resources\QuestionResource;
use App\Models\Questions;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new QuestionResource(Questions::all());
    }

    public function storeQuestionsAnswer(Request $request)
    {
        $question = Questions::all();
        $answer = Answer::all()->pluck('answers_id');
        // $question->map(()->)
        $question->push($answer);    
        return new QuestionResource(Questions::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request,[
            'question' => 'required|string',
            'category' => 'required|string',
        ],[
            'question.required'=> 'Entering the question is required.',
            'category.required'=> 'Entering the category is required.',

            'question.string'=> 'Entering the question is string.',
            'category.string'=> 'Entering the category is string.',
        ]);
        $question = new Questions([
            "question"=> $request->get('question'),
            "category"=> $request->get('category'),
            "updated_at" => $request->get('updated_at'),
            "created_at" => $request->get('created_at')
        ]);
      
        $result = $question->save();
        if($result){
            return new QuestionResource($question);
        }
        else {
            return response()->json('error added');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Request $request)
    {
        $question = Questions::find($request->id);
        return response()->json($question);
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
        $question = Questions::find($id);

        $question->question = $request->question;
        $question->category = $request->category;

        $result = $question->save();

        return new QuestionResource($question);
    }
    
    public function delete($id)
    {
        $question = Questions::find($id);

        $question->delete();

        return response()->json('successfully deleted');
    }

}
