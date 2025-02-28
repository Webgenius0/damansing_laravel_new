<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Helper\Helper;
use App\Traits\apiresponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    use apiresponse;

    /**
     * Update user primary info
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateUserInfo(Request $request)
    {
      
        // Validation rules
        $validation = Validator::make($request->all(), [
            'username' => ['nullable', 'string', 'max:255', 'unique:users,username,' . Auth::id()],
            'email' => ['nullable', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Ensure avatar is an image
            'dob' => ['nullable', 'date'],
            'pet_type' => ['nullable', 'string'],
            'pet_name' => ['nullable', 'string'],
            'pet_weight' => ['nullable', 'integer'],
            'pet_nutrition' => ['nullable', 'string'],
            'activity_level' => ['nullable', 'string'],
        ]);
    
        // Return validation errors if validation fails
        if ($validation->fails()) {
            return $this->error([], $validation->errors()->first(), 422); // Use 422 for validation errors
        }
    
        DB::beginTransaction();
        try {
            $user = Auth::user();
    
            // Update user details
            $user->update($request->only([
                'username',
                'email',
                'dob',
                'pet_type',
                'pet_name',
                'pet_weight',
                'pet_nutrition',
                'activity_level',
            ]));
    
            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                // Delete old avatar if it exists
                if ($user->avatar && file_exists(public_path($user->avatar))) {
                    File::delete(public_path($user->avatar));
                }
    
                // Upload new avatar
                $avatarUrl = Helper::fileUpload($request->file('avatar'), 'users/avatars', $user->username . "-avatar-" . time());
                $user->update(['avatar' => $avatarUrl]);
            }
    
            DB::commit();
    
            // Return success response
            return $this->success([
                'user' => $user,
            ], 'User updated successfully', 200);
    
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error([], $e->getMessage(), 400);
        }
    }

    /**
     * Change Password
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'old_password' => 'required|string|max:255',
            'new_password' => 'required|string|max:255',
        ]);

        if ($validation->fails()) {
            return $this->error([], $validation->errors(), 500);
        }

        try
        {
            $user = User::where('id', Auth::id())->first();
            if (password_verify($request->old_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
                $user->save();
                return $this->success([], "Password changed successfully", 200);
            } else {
                return $this->error([], "Old password is incorrect", 500);
            }
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage(), 500);
        }
    }



    /**
     * Get My Notifications
     * @return \Illuminate\Http\Response
     */
    public function getMyNotifications()
    {
        $user = Auth::user();
        $notifications = $user->notifications()->latest()->get();
        return $this->success([
            'notifications' => $notifications,
        ], "Notifications fetched successfully", 200);
    }


    /**
     * Delete User
     * @return \Illuminate\Http\Response
     */
    public function deleteUser()
    {
        $user = User::where('id', Auth::id())->first();
        if ($user) {
            $user->delete();
            return $this->success([], "User deleted successfully", 200);
        } else {
            return $this->error("User not found", 404);
        }

    }
}
