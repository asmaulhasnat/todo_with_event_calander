<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AcuityScheduling;
use App\Appointment;
use App\AppointmentHistory;
use App\Services\Validator\AppointmentValidator;
use Auth;


class AppointmentController extends Controller
{
    public function index(Request $req)
    {

        echo $now_time = Carbon::now();

        $data['all_appointment'] = Appointment::getAllAppointment($req);
        return view('appointment.index', $data);
    }
    public function create(Request $req)
    {
        return view('appointment.create');
    }

    public function store(AppointmentValidator $appoint)
    {
        $status_code = '';
        $req = $appoint->checkValidation('todo_create_update');
        if (isset($req['fail'])) {
            return back()->withErrors($req['fail']);
        }
        $collection=$req->all();
        $collection = array_merge($collection, ['user_id' => auth()->user()->id]);
        $appointment_store = Appointment::storeData($collection);
        $appointment_store['data']->id ?? null;
        $status_code = 200;

        return success_error($status_code );
        

    }


    public function edit(Request $req, $id)
    {
        $data['appointment'] = Appointment::getSingleAppointment($id);
        
        if ($req->calander) {
            return view('appointment.dynamic_edit_form', $data);
        }
        
        return view('appointment.edit', $data);
    }

    public function update(AppointmentValidator $appoint, $id)
    {
        $status_code = '';

        $req = $appoint->checkValidation('todo_create_update', $id);
        if (isset($req['fail'])) {
            return back()->withErrors($req['fail']);
        }

        $collection = $req->except(['_token','cal']);
        $appointment_update = Appointment::updateData($collection, $id);
        $status_code = 200;
        $redirect=$req->cal ? 'todo.event':'home';
        return success_error($status_code,$redirect);
    }


    public function cancel(Request $req, $id)
    {   
        if($req->cancel_cal){
            $redirect='todo.event';
            Appointment::where('id',$id)->delete();
            return success_error(200 ,$redirect);
        }
        $status_code = '';
        $collection = ['status' => 'cancel'];
        if ($req->note) {
            $collection = array_merge($collection, ['note' => $req->no]);
        }
        $appointment_update = Appointment::updateData($collection, $id);
 
        $status_code = 200;
        $response_data = json_encode([]);


        return success_error($status_code );

    }

}
