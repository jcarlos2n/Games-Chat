<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class UserController extends Controller
{
    const ROLE_ADMIN = 2;
    const ROLE_SUPER_ADMIN = 3;

    public function addAdminRole($id)
    {
        try {

            $user = User::find($id);
            $user->roles()->attach(self::ROLE_ADMIN);

            return response()->json(
                [
                    'success' => true,
                    'message' => "Admin role added to user"
                ],
                200
            );
        } catch (\Exception $exception) {
            Log::error("Error adding admin role to User: " . $exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error adding admin role to user"
                ],
                500
            );
        }
    }

    public function deleteAdminRole($id)
    {
        try {
            $user = User::find($id);

            $user->roles()->detach(self::ROLE_ADMIN);

            return response()->json(
                [
                    'success' => true,
                    'message' => "Admin role deleted to user successfully"
                ],
                200
            );

        } catch (\Exception $exception) {
            Log::error("Error adding admin role to User: " . $exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error adding admin role to user"
                ],
                500
            );
        }
    }

    public function addSuperAdminRole($id)
    {
        try {
            $user = User::find($id);

            $user->roles()->attach(self::ROLE_SUPER_ADMIN);

            return response()->json(
                [
                    'success' => true,
                    'message' => "Super admin role added to user"
                ],
                200
            );

        } catch (\Exception $exception) {
            Log::error("Error adding superadmin role to User: " . $exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error adding superadmin role to user"
                ],
                500
            );
        }
    }

    public function deleteSuperAdminRole($id)
    {
        try {
            $user = User::find($id);

            $user->roles()->detach(self::ROLE_SUPER_ADMIN);

            return response()->json(
                [
                    'success' => true,
                    'message' => "Super admin role deleted to user"
                ],
                200
            );

        } catch (\Exception $exception) {
            Log::error("Error addind superadmin role to User: " . $exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error adding superadmin role to user"
                ],
                500
            );
        }
    }
}
