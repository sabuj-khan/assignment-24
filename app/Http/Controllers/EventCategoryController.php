<?php

namespace App\Http\Controllers;

use App\Models\EventCategory;
use Exception;
use Illuminate\Http\Request;

class EventCategoryController extends Controller
{
    function eventCategoryList(Request $request){
        $user_id = $request->header('id');

       $result = EventCategory::where('user_id', '=', $user_id)->get();

       return $result;
    }


    function eventCategoryCreating(Request $request){
        try{
            $user_id = $request->header('id');
            $name = $request->input('name');
            $newCategory = EventCategory::create([
                    'name'=>$name,
                    'user_id'=>$user_id
                ]);

            return response()->json([
                'status'=>'success',
                'message'=>'The event Category has been created successfully',
                'data'=>$newCategory
            ]);
        }
        catch(Exception $error){
            return response()->json([
                'status'=>'fail',
                'message'=>'TRequest fail to create new category'
            ]);
        }           
    }


    function eventCategoryUpdate(Request $request){
        try{
            $user_id = $request->header('id');
            $category_id = $request->input('id');

            EventCategory::where('id', '=', $category_id)
            ->where('user_id', '=', $user_id)->update([
                'name'=>$request->input('name')
            ]);

            return response()->json([
                'status'=>'success',
                'message'=>'The category has been updated successfully'
            ]);
        }
        catch(Exception $error){
            return response()->json([
                'status'=>'fail',
                'message'=>'Request fail to update event category'
            ]);
        }
    }

    function eventCategoryDelete(Request $request){
        try{
            $user_id = $request->header('id');
            $category_id = $request->input('id');

            EventCategory::where('user_id', '=', $user_id)->where('id', '=', $category_id)->delete();

            return response()->json([
                'status'=>'success',
                'message'=>'The category has been deleted successfully'
            ]);
        }
        catch(Exception $error){
            return response()->json([
                'status'=>'fail',
                'message'=>'Request fail to delete event category'
            ]);
        }

    }

    function eventCategoryById(Request $request){
        $user_id = $request->header('id');
        $category_id = $request->input('id');

        $result = EventCategory::where('user_id','=', $user_id)
        ->where('id', '=', $category_id)->first();

        return $result;
    }


}
