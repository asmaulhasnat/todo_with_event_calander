<?php

namespace App\Services\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Appointment;

class AppointmentValidator 
{
    
    public $request;
    public function __construct(Request $request)
    {
        $this->request=$request;
    }

    public function checkValidation($form_name,$id=false)
    {
    	switch ($form_name) {
    		case 'todo_create_update':
    			
	    		$validator = Validator::make($this->request->all(), [
			        'title' => 'required',
		            'date_time' =>'required',
				    'description' => 'required',
	        	]);
	        	if ($validator->fails()) {
            	return ['fail'=>$validator];
        		}
    			break;
    		default:
    			# code...
    			break;
    	}
       
        return $this->request;
    }

}

 			
