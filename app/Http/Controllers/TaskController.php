<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Exception;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    function allTaskList(Request $request){
        $user_id = $request->header('id');

        return Task::with('eventCategory')->where('user_id', '=', $user_id)->get();
    }
    function taskCreation(Request $request){
        try{
            $user_id = $request->header('id');

            $task = Task::create([
                'user_id'=>$user_id,
                'title'=>$request->input('title'),
                'description'=>$request->input('description'),
                'date'=>$request->input('date'),
                'time'=>$request->input('time'),
                'location'=>$request->input('location'),
                'event_category_id'=>$request->input('event_category_id'),
            ]);

            return response()->json([
                'status'=>'success',
                'message'=>'New task has been created',
                'task'=>$task
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'status'=>'fail',
                'message'=>'An error ocurred while creating task'
            ], 500);
        }
    }


    function taskUpdating(Request $request){
        try{
            $user_id = $request->header('id');
            $task_id = $request->input('id');

            Task::where('id', '=', $task_id)->where('user_id', '=', $user_id)->update([
                'title'=>$request->input('title'),
                'description'=>$request->input('description'),
                'date'=>$request->input('date'),
                'time'=>$request->input('time'),
                'location'=>$request->input('location'),
                'event_category_id'=>$request->input('event_category_id'),
            ]);

            return response()->json([
                'status'=>'success',
                'message'=>'The task has been updated successfully'
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'status'=>'fail',
                'message'=>'an error ocurred while updating task'
            ]);
        }
    }

    function taskDeleting(Request $request){
        try{
            $user_id = $request->header('id');
            $task_id = $request->input('id');

            
            Task::where('id', '=', $task_id)->where('user_id', '=', $user_id)->delete();

            return response()->json([
                'status'=>'success',
                'message'=>'The task has been deleted'
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'status'=>'fail',
                'message'=>'An error ocurred while deleting the task'
            ], 401);
        }
    }


    function taskById(Request $request){
        $user_id = $request->header('id');
        $task_id = $request->input('id');

        
        return Task::where('id', '=', $task_id)->where('user_id', '=', $user_id)->first();
    }


}
