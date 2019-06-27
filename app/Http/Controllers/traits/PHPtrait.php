<?php

namespace App\Http\Controllers\traits;
use Illuminate\Http\Request;
use Log;
use Response;
use Illuminate\Support\Facades\Validator;
trait PHPtrait {


  public function store(Request $request)
 {
   $validator = Validator::make($request->all(), [
               'name' => 'bail|required|max:255',
               'email' => 'required|email|unique:forms',
               'pincode' => 'required|numeric|digits:6',
           ]);
           if ($validator->fails()) {
           
            return Response::json(['errors' => $validator->errors()]);

          }
          else {

          
           \App\Form::create($request->all());

            Log::useFiles(storage_path().'/logs/log.txt');
            Log::info('EMAIL SENT ');

            $data = [
              'success'=>'Form is successfully validated and data has been saved',
              'status'=>1
            ];
            return response()->json($data);
          }

         
 }
 public function create(){
   return view('create');
 }

}

 ?>
