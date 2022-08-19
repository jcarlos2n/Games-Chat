<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function createMessage(Request $request)
    {
        try {
            Log::info("Creating new message");

            $validator = Validator::make($request->all(), [
                'text' => 'required|string',
                'channel_id' => 'required'
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

            $userId = auth()->user()->id;
            $channelId = $request->input('channel_id');

            $channel = DB::table('channel_user')
                ->where('user_id',"=", $userId)
                ->where('channel_id',"=", $channelId)
                ->get();
            if (!$channel) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'The user does not belong to the channel specified or channel doesnt exists'
                    ],
                );
            }

            $text = $request->input('text');
            $channelId = $request->input('channel_id');

            $message = new Message();
            $message->text = $text;
            $message->channel_id = $channelId;
            $message->user_id = $userId;
            $message->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => "Message sended"
                ],
                200
            );
        } catch (\Exception $exception) {

            Log::error("Error creating the new message" . $exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error creating new message" . $exception->getMessage()
                ],
                500
            );
        }
    }

    public function getMessages($channelId)
    {
        try {

            Log::info("Getting all Messages");

            $userId = auth()->user()->id;
            $channel = DB::table('channel_user')
                ->where('user_id',"=", $userId)
                ->where('channel_id',"=", $channelId)
                ->first();
            if (!$channel) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'The user does not belong to the channel specified'
                    ],
                );
            }
            $text = Message::query()
                    ->where('channel_id', '=', $channelId)
                    ->get()
                    ->toArray();



            return response()->json(
                [
                    'success' => true,
                    'message' => 'Message retrieved successfully',
                    'data' => $text
                ],
                200
            );
        } catch (\Exception $exception) {

            Log::error("Error getting messages: " . $exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error getting messages " . $exception->getMessage()
                ],
                500
            );
        }
    }

    public function editMessage(Request $request, $id)
    {
        try {
            Log::info('Edit Message');

            $validator = Validator::make($request->all(), [
                'text' => 'string',
                'channel_id' => 'integer'
            ]);

            if ($validator->fails()) {

                return response()->json(
                    [
                        'success' => false,
                        'message' => $validator->errors()
                    ],
                    400
                );
            }

            $userId = auth()->user()->id;
            $message = Message::query()->where('user_id', '=', $userId)->find($id);

            if (!$message) {

                return response()->json(
                    [
                        'success' => false,
                        'message' => "Message doesn't exists"
                    ],
                    404
                );
            }

            $text = $request->input('text');
            $channelId = $request->input('channel_id');

            if (isset($text)) {
                $message->text = $text;
            };

            if (isset($channelId)) {
                $message->channel_id = $channelId;
            };

            $message->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => "Message edited"
                ],
                200
            );
        } catch (\Exception $exception) {

            Log::error("Error editing the message: " . $exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error editing the message " . $exception->getMessage()
                ],
                500
            );
        }
    }
    public function deleteMessage($id)
    {
        try {
            Log::info('Deleting message');

            $message = Message::query()->find($id);

            if (!$message) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => "Message doesn't exists"
                    ],
                    404
                );
            }

            $message->destroy($id);

            return response()->json(
                [
                    'success' => true,
                    'message' => "Message deleted succesfully"
                ],
                200
            );
        } catch (\Exception $exception) {
            Log::error("Error deleting the message: " . $exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error deleting the message " . $exception->getMessage()
                ],
                500
            );
        }
    }
}
