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
    
            $game = new Game();
            $game->title = $title;
            $game->genre = $genre;
        } catch (\Exception $exception) {
            Log::error("Error creating task: " . $exception->getMessage());

                return response()->json(
                    [
                        'success' => false,
                        'message' => "Error creating tasks"
                    ],
                    500
                );
        }
       

    }
}
