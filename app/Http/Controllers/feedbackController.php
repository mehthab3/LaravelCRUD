<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\feedback;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Mail;

class feedbackController extends Controller
{
    public function feedback(){
    	return view('welcome');
    }

    public function postFeedback(Request $request){

    	// echo "string";exit();
    	// print_r($request->all());exit();
    	$this->validate($request,
    					['name' => 'required',
    					'email' => 'required| email',
    					'feedback'=>'required']);
    	$inputData['feedbackCont'] = $request->get('feedback');
    	$inputData['email'] = $request->get('email');

    	$timestamp=date('Y-m-d H:m:s');
    	$inputData['filename']= $request->get('name').'_'.$timestamp.'.txt';
    	$inputData['name']=$request->get('name');
    	Storage::disk('local')->put($inputData['filename'],$inputData['feedbackCont']);

// print_r($email);exit();
    	Mail::send('email',array('name'=>$inputData['name'],
    							'feedback' => $inputData['feedbackCont']),
    	function($message){
    		$message->from('mtbrockster@gmail.com');
			$message->to('$inputData['email']');
			$message->attach('storage/app/',array('as'=>'$inputData['filename']',
													'mime'=>'application/txt'));    		
    	});

    	event( new feedbackSubmit($inputData)); 

    	feedback::create($request->all());


    	return back()->with('success','Thank you for contacting us');

    }
}
