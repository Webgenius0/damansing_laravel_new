<?php

namespace App\Http\Controllers\API;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use App\Models\SystemSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function sendMessage(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'full_name'    => 'required|string|max:255',
            'email'        => 'required|email',
            'phone_number' => 'required|string|max:20',
            'message'      => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

       
        $contactData = $request->only(['full_name', 'email', 'phone_number', 'message']);

        
        $systemSetting = SystemSetting::select('email')->first();
     

       
        if (!$systemSetting || empty($systemSetting->email)) {
            return response()->json(['error' => 'No email address is configured in the system settings.'], 404);
        }

        try {
           
            Mail::to($systemSetting->email)->send(new ContactMail($contactData));

          
            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent successfully.',
                'code'    => 200,
            ]);
        } catch (\Exception $e) {
           
            return response()->json([
                'success' => false,
                'error'   => 'Failed to send the email. Please try again later.',
                'details' => $e->getMessage(), 
            ], 500);
        }
    }
}
