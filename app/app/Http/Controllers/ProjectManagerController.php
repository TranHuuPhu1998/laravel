<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\ProjectManagerResource;
use App\Models\ProjectManager;
use App\User;

class ProjectManagerController extends Controller
{
    public function index(){
        return new ProjectManagerResource(ProjectManager::all());
    }

    public function createProject(Request $request){
        $this->validate($request , [
            'project_client' => 'required|string',
            'project_name' => 'required|string',
            'project_type' => 'required|string',
            'project_status' => 'required|string',
            'date_start' => 'required|date',
            'date_end' => 'required|date'
        ], [
            'project_client.required' => 'Entering the project client is required',
            'project_client.string' => 'Entering the project client is string',
            'project_name.required' => 'Entering the project name is required',
            'project_name.string' => 'Entering the project name is string',
            'project_status.required' => 'Entering the project status is required',
            'date_start.required' => 'Entering the date start is required',
            'date_start.date' => 'Entering the date start is date',
            'date_end.required' => 'Entering the date end is required',
            'date_end.date' => 'Entering the date end is date',
        ]);
        
        $project = new ProjectManager([
            'project_id' => $request->get('project_id'),
            'project_client' => $request->get('project_client'),
            'project_name' => $request->get('project_name'),
            'project_type' => $request->get('project_type'),
            'project_status' => $request->get('project_status'),
            'date_start' => $request->get('date_start'),
            'date_end' => $request->get('date_end'),
            'members' => $request->get('members')
        ]); 
        
        $result = $project->save();

        if($result){
            return new ProjectManagerResource($project);
        }
        else {
            return response()->json('error added');
        }
    }     

    public function updateProject(Request $request, $id){
        $project = ProjectManager::find($id);

        $project->project_client = $request->project_client;
        $project->project_name = $request->project_name;
        $project->project_type = $request->project_type;
        $project->project_status = $request->project_status;
        $project->date_start = $request->date_start;
        $project->date_end = $request->date_end;
        $project->members = $request->members;

        $result = $project->save();
        if($result){
            return new ProjectManagerResource($project);
        }else {
            return response()->json('error added');
        }
    }
                                                                        
    public function deleteProject($id){

        $project = ProjectManager::find($id);
        $users = User::where('users_id', $id)->get();

        foreach ($users as $user) {
            $user = User::find($user->id);
            $user->users_id = null;
            $user->save();
        }

        // $project->delete();
        return response()->json('successfully deleted');
    }   
}
