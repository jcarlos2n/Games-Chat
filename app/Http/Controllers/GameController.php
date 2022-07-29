<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class GameController extends Controller
{
    public function addGame(Request $request){
        try {
            Log::info("Creating a game");

            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'genre' => 'required|string'
            ]);
    
            if ($validator->fails()) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => $validator->errors()
                    ],400);
            };
    
            $title = $request->input('title');
            $genre = $request->input('genre');
            $userId = auth()->user()->id;
    
            $game = new Game();
            $game->title = $title;
            $game->genre = $genre;
            $game->user_id = $userId;

            $game->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => "Game created"
                ],
                200
            );
        } catch (\Exception $exception) {
            Log::error("Error creating game: " . $exception->getMessage());

                return response()->json(
                    [
                        'success' => false,
                        'message' => "Error creating game"
                    ],
                    500
                );
        }
       

    }
}
