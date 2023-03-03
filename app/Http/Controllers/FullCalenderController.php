<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment as Event;

class FullCalenderController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = Event::whereDate('date_time', '>=', $request->start)
                ->whereDate('date_time',   '<=', $request->end)->selectRaw('id,title title,date_time as start,date_time as end')
                ->get();

            return response()->json($data);
        }

        return view('appointment.full_calander');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ajax(Request $request)
    {

        switch ($request->type) {
            case 'add':
                $event = Event::create([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);

                return response()->json($event);
                break;

            case 'update':
                $event = Event::find($request->id)->update([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);
                Event::find($request->id)->update([
                    'title' => $request->title,
                    'date_time' => $request->start,
                ]);

                return response()->json($event);
                break;

            case 'delete':
                $event = Event::find($request->id)->delete();

                return response()->json($event);
                break;

            default:
                # code...
                break;
        }
    }
}
