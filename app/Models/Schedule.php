<?php

namespace App\Models;

use DateInterval;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Schedule extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getSchedulesForDay( $date )
    {
        return $this->whereDate('date', $date)->pluck('hour')->toArray();
    }

    public function show( $id )
    {
        $schedule = Schedule::find( $id );

        if ( !$schedule ) {
            // Tratar o caso em que o agendamento não é encontrado
            abort(404);
        }

        return view('admin.screens.schedules.show', compact('schedule'));
    }

    protected $dates = ['date'];

}
