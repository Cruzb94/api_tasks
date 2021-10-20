<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function saveTask(Request $request) {

        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        if(!$validated) {
            return response()->json([
                'message' => 'All fields are required'
            ], 400);
        } 

        $new_task = array(
            'name' => $request->name,
            'description' => $request->description,
            'completed' => $request->completed,
            'user_id' =>  $request->user()->id
        );

        $task = Task::create($new_task);

        if(!$task) {
            return response()->json([
                'message' => 'save error'], 400
            );
        } 
        
        return response()->json([
            'task' => $task,
            'message' => 'Successfully created task'], 200
        );
        
    }

    public function updateTask(Request $request) {

        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'completed' => 'required'
        ]);

        if(!$validated) {
            return response()->json([
                'message' => 'update error'
            ], 400);
        } 

        $task = Task::find($request->id);

        if($task) {
            $task->name = $request->name;
            $task->description = $request->description;
            $task->completed = $request->completed;
            $task->save();

            return response()->json([
                'message' => 'Successfully updated task'], 200
            );
        } else {
            return response()->json([
                'message' => 'update error'
            ], 400);
        }   
    }

    public function getTasks(Request $request) {
        return response()->json([
            'tasks' => Task::where('user_id', $request->user()->id)->get(),
        ], 200);
    }

    public function getTasksCompleted(Request $request) {
        return response()->json([
            'tasks' => Task::where('user_id', $request->user()->id)->where('completed', 1)->get(),
        ], 200);
    }

    public function deleteTask(Request $request) {

        $task = Task::where('id',$request->id)->delete();

        if(!$task) {
            return response()->json([
                'message' => 'delete task error'], 400
            );
        } 

        return response()->json([
            'message' => 'Successfully deleted task'], 200
        );
    }
}