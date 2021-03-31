<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Resources\TasksResource;
use App\ModelsTask;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index(){
        return new TasksResource(ModelsTask::all());
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){

        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'required|string', 
            'content' => 'required|string',
            'status' => 'required|number',
        ], [
            'title.required' => 'Entering the question is required.',
            'description.required' => 'Entering the description is required.',
            'content.required' => 'Entering the content is required.',
            'status.required' => 'Entering the content is required'
        ]); 

        $tasks = new ModelsTask([
            'title' => $request>get('title'),
            'description' => $request->get('description'),
            'content' => $request->get('content'),
            'status' => $request->get('status'),
        ]);

        $result = $tasks->save();

        if($result){
            return new TasksResource($tasks);
        }
        else {
            return response()->json('error added');
        }
    }

    public function edit(Request $request){
        $tasks = ModelsTask::find($request->id);
        return response()->json($tasks);
    }

}
