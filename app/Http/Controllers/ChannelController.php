<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ChannelController extends Controller
{
    public function createChannel(Request $request){
      try {
        $user_id = auth()->user()->id;
        $validator = Validator::make($request->all(), [
            'game_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    "success" => false,
                    "message" => $validator->errors()
                ],
                400
            );
        };
        $game_id = $request->input('game_id');
        $game_id = Game::query()
        ->where('id', '=' , $game_id)
        ->first()->id;
        
        if (!$game_id) {
            return [
                'success' => true,
                'message' => 'These game doesnt exist'
            ];
        }

        $channel = new Channel();
        $channel->game_id = $game_id;
        $channel->save();
        $channel->users()->attach($user_id);

        return response()->json([
            'success' => true,
            'message' => "Channel created succesfully"
        ],200);
        
        

      } catch (\Exception $exception) {
        Log::error("Error channel create: " . $exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error channel create" . $exception->getMessage()
                ],
                500
            );
      }  
        
    }

    public function joinToChannel($id){
        try {
            Log::info("Join to channel");

            $user = auth()->user()->id;
            $channel = Channel::find($id);
            $channel->users()->attach($user);
            if (!$channel) {

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error joining to channel"
                ],
                500
            );
            }
            return response()->json(
                [
                    'success' => true,
                    'message' => "joinned to channel"
                ],
                500
            );


        } catch (\Exception $exception) {
            Log::error("Error joinning to channel: " . $exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error joinning to channel"
                ],
                500
            );
        }
    }

    public function outChannel($id){
        try {
            Log::info("Join to channel");

            $user = auth()->user()->id;
            $channel = Channel::find($id);
            $channel->users()->detach($user);
            if (!$channel) {

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error out going to channel"
                ],
                500
            );
            }
            return response()->json(
                [
                    'success' => true,
                    'message' => "out of channel"
                ],
                500
            );


        } catch (\Exception $exception) {
            Log::error("Error joinning to channel: " . $exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error joinning to channel"
                ],
                500
            );
        }
    }

    public function deleteChannel($id)
    {
        try {

            Log::info("Deleting channel");
    
            $channel = Channel::find($id);
            if (!$channel) {
                return response()->json([
                    "success" => true,
                    "message" => "Channel doesnt exist"
                ], 404);
            }
            $channel::destroy($id);
            return response()->json([
                "success" => true,
                "message" => "Channel deleted"
            ], 200);
        } catch (\Exception $exception) {

            Log::error("Error deleting channel: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error deleting channel' . $exception->getMessage(),
            ], 500);
        }
    }
}
