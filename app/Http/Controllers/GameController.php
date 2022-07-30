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

    public function getGames(){
        try {
            Log::info("Getting all games");

            $games = Game::query('games')
            ->get()
            ->toArray();

            return response()->json([
                'success' => true,
                'message' => 'Game retrieve succesfully',
                'data' => $games
            ],200);

        } catch (\Exception $exception) {

            Log::error("Error getting games: " . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error getting games' . $exception->getMessage(),

            ], 500);
        }
    }

    public function updateGame(Request $request, $id){
        try {

            $game =  Game::query()
            ->where('id', '=', $id)
            ->first();

        if (!$game) {
            return [
                'success' => true,
                "message" => "These game doesn't exist"
            ];
        }

        Log::info("Updating game");

        $game = Game::find($id);
        if (!$game) {
            return response()->json([
                "success" => true,
                "message" => "Game doesnt exist"
            ], 404);
        }

        $title = $request->input('title');
        $genre = $request->input('genre');

        $game->title = $title;
        $game->genre = $genre;

        $game->save();
        return response()->json([
            "success" => true,
            "message" => "Game updated"
        ], 200);

        } catch (\Exception $exception) {

            Log::error("Error updating game: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error updating game' . $exception->getMessage(),
            ], 500);

        }
    }

    public function deleteGame($id){
        try {

            $game =  Game::query()
                ->where('id', '=', $id)
                ->first();
            if (!$game) {
                return [
                    'success' => true,
                    "message" => "These game doesn exist"
                ];
            }

            Log::info("Deleting game");

            $game = Game::find($id);
            if (!$game) {
                return response()->json([
                    "success" => true,
                    "message" => "Game doesnt exist"
                ], 404);
            }

            $game::destroy($id);
            return response()->json([
                "success" => true,
                "message" => "Game deleted"
            ], 200);

        } catch (\Exception $exception) {

            Log::error("Error deleting game: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error deleting game' . $exception->getMessage(),
            ], 500);

        }
    }
}
