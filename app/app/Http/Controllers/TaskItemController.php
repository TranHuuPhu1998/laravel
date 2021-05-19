<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TaskItemResource;
use App\Models\TaskItem;

use Validator;

class TaskItemController extends Controller
{
    
    public function storeTaskTtem(){
        return new TaskItemResource(TaskItem::all());
    }

    public function createTaskItem(Request $request , $id) {
        
        $this->validate($request , [
            'taskname' => 'required|string'
        ], [
            'taskname.required' => 'Entering the taskname is required.',
            'taskname.string' => 'Entering the taskname is string' 
        ]);
        
        $taskItem = new TaskItem([
            'taskid' =>  $id,
            'taskname' => $request->get('taskname'),
            'status' => $request->get('status'),
        ]);

        $result = $taskItem->save();

        if($result){
            return new TaskItemResource($taskItem);
        }else {
            return response()->json('error added');
        }
    }

    public function update(Request $request, $id){
        $taskItem = TaskItem::find($id);

        $taskItem->taskname = $request->taskname;
        $taskItem->status = $request->status;
        $taskItem->taskid = $request->taskid;

        $result = $taskItem->save();
        return new TaskItemResource($taskItem);
    }

    public function delete($id){
        $taskItem = TaskItem::find($id);
        $taskItem->dalete();
        return response()->json('successfully deleted');
    }
}
