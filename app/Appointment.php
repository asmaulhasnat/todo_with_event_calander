<?php

namespace App;
use Auth;


use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Scopes\UserAppointmentScope;
use App\Traits\CommonAccessor;

class Appointment extends Model
{	
    use CommonAccessor;
	protected $table='todos';
	protected $fillable=['id','user_id','title','description','date_time','note','status'];

    public static function boot(){
        parent::boot();
        static::addGlobalScope(new UserAppointmentScope);
       
       
    }    





    public static function getAllAppointment($request){

    	try {
    		$before_time=$request->before_time ?? $request['before_time'] ?? 0;
    		$appointment=self::whereNotNull('id');

            if(isset($request->from_date) && isset($request->to_date)){
                $from_date=global_date_time($request->from_date ,get_auth_time_zone(),config('app.timezone'));
                $to_date=global_date_time($request->to_date ,get_auth_time_zone(),config('app.timezone'));
                $appointment=$appointment->whereBetween('date_time_utc',[$from_date,$to_date]);
            }

    		if($before_time){
			 $from_date=date('Y-m-d H:i:s');
			 $to_date=date('Y-m-d H:i:s',strtotime('+'.$before_time.' minutes'));
			 $appointment=$appointment->whereBetween('date_time_utc',[$from_date,$to_date]);
    		}
            $pdf=$request->pdf ?? 0;
            if ($pdf) {
              return $appointment=$appointment->get();
            }
    		
    		//return $appointment->toSql();
    		return $appointment=$appointment->paginate(5)->appends($_GET);
    		
    	} catch (\Exception $e) {
    		dump($e);
    		
    	}

    }

    public static function getAllAppointmentCalender($request){

        try {
            return self::selectRaw('appointments.first_name,false,date(appointments.date_time_utc) as start_time,date(appointments.date_time_utc) as end_time,appointments.id')->get();
            
        } catch (\Exception $e) {
            dump($e);
            
        }

    }




   

    public static function getSingleAppointment($id){

    	try {
    		return $appointment=self::find($id);
    		
    	} catch (\Exception $e) {
    		dump($e);
    		
    	}

    }
    

}
