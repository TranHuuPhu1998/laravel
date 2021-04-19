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
        
        $project= new ProjectManager([
            'project_client' => $request->get('project_client'),
            'project_name' => $request->get('project_name'),
            'project_type' => $request->get('project_type'),
            'project_status' => $request->get('project_status'),
            'date_start' => $request->get('date_start'),
            'date_end' => $request->get('date_end'),
            
        ]);
            

       
        foreach ($members->getCollection() as $member) {
           // $user = User::find($member->id);
            // $user->users_id = $project->id;
            echo $member;
            // $user->save();
        }
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
        return new ProjectManagerResource($project);
    }
                                                                        
    public function deleteProject($id){

        $project = ProjectManager::find($id);
        $users = User::where('users_id', $id)->get();
        echo $users;
        foreach ($users as $user) {
            $user = User::find($user->id);
            $user->users_id = null;
            $user->save();
        }

        // $project->delete();
        return response()->json('successfully deleted');
    }   
}
