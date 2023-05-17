<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();

        return view('admin.screens.schedules.index', ['schedules' => $schedules]);
    }

    public function create()
    {
        return view('admin.screens.schedules.create');
    }

    public function show( $id ) 
    {
        $user = Auth::user();
        $schedule = $user->schedules->find($id);

        if ( !$schedule ) {
            return Redirect::to('/dashboard/');
        }

        if ( Auth::user()->id != $schedule->user_id) {
            return view('admin.screens.schedules.index');
        }

        $userSchedules = Schedule::where('user_id', auth()->user()->id)->pluck('id');

        $previousSchedule = Schedule::whereIn('id', $userSchedules)->where('id', '<', $id)->orderBy('id', 'desc')->first();
        $nextSchedule = Schedule::whereIn('id', $userSchedules)->where('id', '>', $id)->orderBy('id', 'asc')->first();
        
        return view('admin.screens.schedules.show', compact('schedule', 'previousSchedule', 'nextSchedule'));

    }

    public function store( Request $request )
    {
        $schedule = new Schedule;

        $schedule->guest_name = $request->guest_name;
        $schedule->user_id = $request->user_id;
        $schedule->date = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
        $schedule->hour = $request->hour;
        $schedule->guest_amount = $request->guest_amount;

        $schedule->save();

        return redirect('/dashboard');
    }

    public function getSchedules( Request $request )
    {
        $date = $request->input('date');

        $carbonDate = \Carbon\Carbon::createFromFormat('d/m/Y', $date);

        // Verificar se é domingo
        if( $carbonDate->dayOfWeek === Carbon::SUNDAY  ) {
            $schedules = ['18:00', '18:45', '19:30', '20:15', '21:00', '21:45', '22:30', '23:15', '23:59'];
        } else {
            $formattedDate = \Carbon\Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
            $schedules = Schedule::whereDate('date', $formattedDate)->pluck('hour')->map(function ($time) {
                return date_format(date_create($time), 'H:i');
            })->toArray();
        }

        return response()->json(['hourList' => $schedules]);

    }

    public function cancelSchedule( $id )
    {
        $schedule = Schedule::find( $id );

        if( $schedule ){
            $schedule->delete();
            return redirect('/dashboard')->with('success', 'Agendamento cancelado com sucesso!');
        } else {
            return redirect('/dashboard')->with('error', 'Agendamento não encontrado');
        }

        return;
    }
    
}
