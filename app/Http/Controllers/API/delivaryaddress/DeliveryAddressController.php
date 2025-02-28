<?php

namespace App\Http\Controllers\API\delivaryaddress;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Traits\apiresponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\DelivaryAddress;
class DeliveryAddressController extends Controller
{
    use apiresponse;


public function UpdateOrCreate(Request $request)
{
    // Validation rules
    $validator = Validator::make($request->all(), [
        'address' => 'required|string',
        'state' => 'required|string',
        'country' => 'required|string',
        'zip_code' => 'required|string',
        'phone' => 'required|string',
        'email' => 'required|email',
        'address_type' => 'nullable|string',
        'address_title' => 'nullable|string',
       
    ]);

   
    if ($validator->fails()) {
        return $this->error([], $validator->errors()->first(), 422); // Use 422 for validation errors
    }

   
    $data = $request->all();
    $data['user_id'] = Auth::user()->id; 
    $data['zip_code'] = $request->zip_code; 

    // Begin a transaction
    DB::beginTransaction();
    try {
      
        $deliveryAddress = DelivaryAddress::updateOrCreate(
            ['user_id' => $data['user_id']], 
            $data 
        );

       
        DB::commit();

  
        if ($deliveryAddress->wasRecentlyCreated) {
        
            return $this->success([
               $deliveryAddress
            ], 'Address created successfully', 200);
        } else {
           
            return $this->success([
               $deliveryAddress
            ], 'Address updated successfully', 200);
        }

    } catch (\Exception $e) {
        // Rollback in case of error
        DB::rollBack();
        return $this->error([], $e->getMessage(), 500);
    }
}

}
