<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Events\TaskCreatedEvent;
use App\Events\TaskUpdatedEvent;
use App\Events\TaskDeletedEvent;


class TasksController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function addTask(Request $request){
        $task = new Task;
        $description = $request->input('description');
        $user_id      = $request->input('user_id');
        $user         = User::find($user_id);

        if (!$user) {
            throw new \Exception("user not found.");
        }

        if(!$description){
            return response()->json([
                "message" => "description is required",
            ]); 
        }

        $task->description = $description;
        $task->user_id = $user_id;
        $task->status = "backlog";
        

        $task->save();

        event(new TaskCreatedEvent($task));

        return response()->json([
            'message' => 'task created successfully',
        ]);
    }

    public function updateTask(Request $request, $id){

    $task = Task::find($id);

    if (!$task) {
        return response()->json(['message' => 'Task not found'], 404);
    }

    $description = $request->input('description');
    $status = $request->input('status');
    $task->description = $description;
    $task->status = $status;

    $task->save();

    event(new TaskUpdatedEvent($task));

    return response()->json(['message' => 'Task updated successfully', 'data' => $task]);
    }

    public function deleteTask($id){

    $task = Task::find($id);

    if (!$task) {
        return response()->json(['message' => 'Task not found'], 404);
    }

    event(new TaskDeletedEvent($task));
    $task->delete();


    return response()->json(['message' => 'Task deleted successfully']);
    }

    public function getAllTasks(){
    $tasks = Task::all();
    return response()->json(['data' => $tasks]);
    }

        // Method to get tasks by user ID
        public function getTasksByUserId(Request $request, $userId)
        {
            // Find the user by ID
            $user = User::find($userId);
    
            // If user not found, return error response
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }
    
            // Get tasks associated with the user
            $tasks = Task::where('user_id', $userId)->get();
    
            // Return tasks as JSON response
            return response()->json(['data' => $tasks]);
        }
    
}
