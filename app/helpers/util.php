<?php
if(!function_exists('common_curl')){
	function common_curl($url,$data=false,$method=false){

		$userID = env('ACUITY_USER_ID');
		$key = env('ACUITY_API_KEY');

		// URL for all appointments (just an example):
		$url = 'https://acuityscheduling.com/api/v1/appointments.json';

		// Initiate curl:
		// GET request, so no need to worry about setting post vars:
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);

		// Grab response as string:
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// HTTP auth:
		curl_setopt($ch, CURLOPT_USERPWD, "$userID:$key");

		// Execute request:
		$result = curl_exec($ch);

		// Don't forget to close the connection!
		curl_close($ch);

		return $data = json_decode($result, true);
		}

}

if(!function_exists('common_acuity_schedule')){
	function common_acuity_schedule($url,$data=[],$method=false){
		$userId = env('ACUITY_USER_ID');
        $apiKey = env('ACUITY_API_KEY');

		$acuity = new \AcuityScheduling(array(
		  'userId' => $userId,
		  'apiKey' => $apiKey
		));
		return $appointment = $acuity->request($url, array(
		  'method' => $method,
		  'data' => $data
		));
	}

}

if(!function_exists('global_date_time')){
	function global_date_time($date,$from_timezone ='Asia/Dhaka',$to_timezone='UTC',$format='Y-m-d H:i:00',$ofset_string=false){
		$date_string=	\Carbon\Carbon::parse($date,$from_timezone)->setTimezone($to_timezone);
		if ($ofset_string) {
			return $date_string->format($format).' '.$date_string->getOffsetString();
			# code...
		}
		return $date_string->format($format);
		
	}

}

if(!function_exists('T_general_date_conversing')){
	function T_general_date_conversing($date,$format='Y-m-d H:i:s'){
		$date=str_replace("T"," ",$date);
		$date=explode(' ', $date);
		$parse_date=$date[0].' '.$date[1];
		return 	\Carbon\Carbon::parse($parse_date)->format($format);
	}

}

if(!function_exists('general_date_conversing')){
	function general_date_conversing($date,$format='Y-m-d H:i:s'){
		
		return 	\Carbon\Carbon::parse($date)->format($format);
	}

}

if(!function_exists('add_local_time')){
	function add_local_time($date,$timezone,$format='Y-m-d H:i:s'){
		return 	\Carbon\Carbon::parse($date)->setTimezone($timezone)->format($format);
	}

}

if(!function_exists('attribute_select')){
	function attribute_select($value1,$value2,$showing_attribute='selected'){
		return $value1==$value2 ? $showing_attribute:'';
	}

}

if(!function_exists('get_auth_time_zone')){
	function get_auth_time_zone(){
		return \Auth::user()->UserSetting->time_zone ?? config('app.timezone');
	}

}

if(!function_exists('get_auth_appointment_type')){
	function get_auth_appointment_type(){
		return  1;
	}

}

if(!function_exists('get_created_by')){
	function get_created_by($appointment_type_id){
		return  1;
	}

}

if(!function_exists('success_error')){
	function success_error($code,$redirect=false,$full_url=false){
		if ($code==200) {
			 \Session::flash('success', 'Action Successfull');
       		if ($redirect) {
       			if ($full_url) {
       				return redirect($redirect);
       			}
       			return redirect(route($redirect));
       		}
       		return back();
			// code...
		}
		 \Session::flash('error', 'Something went to wrong');
       	return back();
		
	}

}

if(!function_exists('dial_code')){
	function dial_code(){
		return json_decode(file_get_contents(public_path('json/country_dial_info.json')));
		
	}

}
if(!function_exists('dial_code')){
	function dial_code(){
		return json_decode(file_get_contents(public_path('json/country_dial_info.json')));
		
	}

}
if(!function_exists('user_access')){
	function user_access($is_admin=0){
		return \Auth::user()->is_admin==$is_admin;
		
	}

}

if(!function_exists('execution_rule_list')){
	function execution_rule_list(){
		return ['message_sent'=>'Message is sent','anything'=>'Contact replies with any response','expression'=>'Contact replies with an expression ','category'=>'Contact replies with an category'];
		
}


if(!function_exists('check_idle_hour')){
	function check_idle_hour($appointment_time){

		$idle_date=general_date_conversing($appointment_time,'Y-m-d');

		$idle_hour=\App\MessageIdlePeriod::whereNotNull('start_time')->whereNotNull('end_time')->first();

		if (empty($idle_hour)) {
			return false;
		}
		else{
			$start_time=general_date_conversing($idle_date.' '.$idle_hour->start_time,'Y-m-d H:i:s');
			$end_time=general_date_conversing($idle_date.' '.$idle_hour->end_time,'Y-m-d H:i:s');

			if ($idle_hour->start_time>$idle_hour->end_time) {
			$idle_date=\Carbon\Carbon::parse($idle_date)->addDays(1)->format('Y-m-d');
			$end_time=general_date_conversing($idle_date.' '.$idle_hour->end_time,'Y-m-d H:i:s');
			}


			//check  appointment in an idle range

			if ($appointment_time>$start_time && $appointment_time<$end_time) {
				//\Log::info('yes');
				return \Carbon\Carbon::parse($end_time)->addSeconds(1)->format('Y-m-d H:i:s');
			}
			return false;

		}
		
	}

}

if(!function_exists('send_sms')){
	function send_sms($message, $recipients){
		$account_sid = env("TWILIO_SID");
        $auth_token = env("TWILIO_AUTH_TOKEN");
        $twilio_number = env("TWILIO_NUMBER");
        $client = new \Twilio\Rest\Client($account_sid, $auth_token);
        return $client->messages->create($recipients, ['from' => $twilio_number, 'body' => $message]);
		
	}
}









}















