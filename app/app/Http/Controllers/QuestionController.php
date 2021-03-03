<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Resources\QuestionResource;
use App\Questions;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'answers_id' => 'required|integer',
            'question' => 'required|string',
            'category' => 'required|string',
        ],[
            'answers_id.required'=> 'Entering the answers_id is required.',
            'question.required'=> 'Entering the question is required.',
            'category.required'=> 'Entering the category is required.',

            'answers_id.integer'=> 'Entering the answers_id is integer.',
            'question.integer'=> 'Entering the question is string.',
            'category.integer'=> 'Entering the category is string.',
        ]);
        $question = new Questions([
            "answers_id"=> $request->get('answers_id'),
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $question->answers_id = $request->id;
        $question->answers_id = $request->answers_id;
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
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
