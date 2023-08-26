<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Custumer;
use Validator;

class CustomerController extends Controller
{


	public function creat(Request $request) {

		//echo "<pre>";print_r($request->all());die;
            
    	//echo 1234567;die;
        $validator = Validator::make(request()->all(), [
            'first_name' => 'required|max:40',
            'last_name' => 'required|max:40',
            'email' => 'required|email|max:40',
            'address' => 'required|max:500',
            'contact_number' => 'required|max:100',
            'qualification' => 'required|max:200',
            'work_ex_year' => 'required|max:30',
            'candidate_dob' => 'required|date',
            'gender' => 'required',
            'resume' => 'required|mimes:jpg,png,jpeg,gif,svg,pdf|max:2048',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }


        //echo 12345;die;
 
        $user = new Custumer;
        $user->first_name = request()->first_name;
        $user->last_name = request()->last_name;
        $user->email = request()->email;
        $user->address = request()->address;
        $user->contact_number = request()->contact_number;
        $user->qualification = request()->qualification;
        $user->work_ex_year = request()->work_ex_year;
        $user->candidate_dob = request()->candidate_dob;
        $user->gender = request()->gender;

        
       if($request->hasFile('resume')){
                 $image = 'profile_'.time().'.'.$request->resume->extension();   
                  $request->resume->move(public_path('image/'), $image);
                  $image = "iamge/".$image;
       
       }
         $user->resume = $image;
        $user->save();
 
        return response()->json([
        	'status'=>true,
        	'data'	=>array(
            'msg' => 'Custumer Created Successfully.',
           )
        ]);
    }

    public function list(){
      
       $user=Custumer::get();
      
      return response()->json($user, 201);

    }

    public function update(Request $request){


    	 $validator = Validator::make(request()->all(), [
            'first_name' => 'required|max:40',
            'last_name' => 'required|max:40',
            'email' => 'required|email|max:40',
            'address' => 'required|max:500',
            'contact_number' => 'required|max:100',
            'qualification' => 'required|max:200',
            'work_ex_year' => 'required|max:30',
            'candidate_dob' => 'required|date',
            'gender' => 'required',
            'resume' => 'required|mimes:jpg,png,jpeg,gif,svg,pdf|max:2048',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

       $user = $request->all(); 
       $lesson= Custumer::where('id',$request->id)->update($user);
 
        return response()->json([
        	'status'=>true,
        	'data'	=>array(
            'msg' => 'Update  successful.',
           )
        ]);

    }

    public function delete(Request $request){

    	//echo 2345;die;

    	$lesson= Custumer::where('id',$request->id)->first();

    	$lesson->delete();


    	return response()->json([
        	'status'=>true,
        	'data'	=>array(
            'msg' => 'Daleted  successful.',
           )
        ]);


    }
   
}
