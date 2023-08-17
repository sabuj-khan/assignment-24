<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    function eventListShow(Request $request){
        $user_id = $request->header('id');

       $result = Event::with('eventCategory')->where('user_id', '=', $user_id)->get();

       return $result;
    }


    
    function eventCreation(Request $request){
        
            try{
                $user_id = $request->header('id');
            // Create the event
                $event = Event::create([            
                    'user_id'=>$user_id,
                    'title'=>$request->input('title'),
                    'description'=>$request->input('description'),
                    'date'=>$request->input('date'),
                    'time'=>$request->input('time'),
                    'location'=>$request->input('location'),
                    'event_category_id'=>$request->input('event_category_id'),
                    
                ]);
        
                return response()->json([
                    'status' =>'success',
                    'message' => 'Event created successfully',
                    'event'=>$event
                ]);
            }
            catch(Exception $e){
                return response()->json([
                    'status'=>'fail',
                    'message'=>'An error ocurred while creating Event'
                ], 401);
            }
        
    }


    function eventUpdating(Request $request){
        try{
            $user_id = $request->header('id');
            $event_id = $request->input('id');
            
            Event::where('id', '=', $event_id)->where('user_id', '=', $user_id)
            ->update([

                'title'=>$request->input('title'),
                'description'=>$request->input('description'),
                'date'=>$request->input('date'),
                'time'=>$request->input('time'),
                'location'=>$request->input('location'),
                'event_category_id'=>$request->input('event_category_id'),
            ]);

            return response()->json([
                'status'=>'success',
                'message'=>'Event has been updated'
            ]);
        }
        catch(Exception $error){
            return response()->json([
                'status'=>'fail',
                'message'=>'Request fail to update event'
            ]);
        }
    }


    function eventDeleting(Request $request){
        try{
            $user_id = $request->header('id');
            $event_id = $request->input('id');

            Event::where('id', '=', $event_id)->where('user_id', '=', $user_id)->delete();

            return response()->json([
                'status'=>'success',
                'message'=>'The event has been deleted'
            ]);
        }
        catch(Exception $error){
            return response()->json([
                'status'=>'fail',
                'message'=>'Request fail to delete the event'
            ]);
        }
    }


    function eventById(Request $request){
            $user_id = $request->header('id');
            $event_id = $request->input('id');

            $result = Event::where('id', '=', $event_id)->where('user_id', '=', $user_id)->first();

            return $result;
    }











}
