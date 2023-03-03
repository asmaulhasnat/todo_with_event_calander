<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AcuityScheduling;

use App\Appointment;
use App\AppointmentHistory;
use Carbon\Carbon;
use PDF;




class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $req)
    {

        $data['all_appointment'] = Appointment::getAll($req);
        $data['req'] = $req;

        return view('home', $data);
    }
}
