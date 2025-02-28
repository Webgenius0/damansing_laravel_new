<?php
namespace App\Traits;

use App\Models\User;
use App\Notifications\OtpNotification;
use Illuminate\Support\Facades\Hash;

trait apiresponse
{
    public function success($data=[], $message, $code = 200,$token=null)
    {
        $response=[
            'status' => true,
            'message' => $message,
            'code' => $code,
        ];
        if($token){
            $response['token_type'] = 'Bearer';
            $response['token'] = $token;
        }
        if($data){
            $response['data'] = $data;
        }
        return response()->json($response, $code);
    }

    public function error($error, $message = [], $code = 422)
    {
      
        if ($message instanceof \Illuminate\Support\MessageBag) {
            
            $responseMessage = $message->first(); 
        } else {
            
            $responseMessage = $error;
        }
    
        $response = [
            'status' => false,
            'message' => $responseMessage,  
            'code' => $code,
        ];
    
        return response()->json($response, $code);
    }
    



    public function generateOtp(User $user)
    {
        $otp = rand(1000, 9999);
        $user->otp = $otp;
        $user->otp_created_at = now();
        $user->otp_expired_at =now()->addMinutes(10);
        $user->notify(new OtpNotification($otp));

        $user->save();

        return response()->json(['message' => 'OTP sent to your email!']);
    }
}
