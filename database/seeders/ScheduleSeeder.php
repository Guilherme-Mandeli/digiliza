<?php

namespace Database\Seeders;

use DateInterval;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $guestAmounts = range(2, 20);
        $availableDates = $this->getAvailableDates();
        $availableTimes = [
            '18:00', '18:45', '19:30', '20:15',
            '21:00', '21:45', '22:30', '23:15', '23:59'
        ];
        $repeatedDays = ['Monday', 'Wednesday', 'Friday'];

        foreach ($availableDates as $date) {
            foreach ($repeatedDays as $day) {
                $randomGuestAmount = $guestAmounts[array_rand($guestAmounts)];
                $randomTime = $availableTimes[array_rand($availableTimes)];

                DB::table('schedules')->insert([
                    'guest_name' => 'Nome do Convidado',
                    'guest_amount' => $randomGuestAmount,
                    'date' => $date,
                    'hour' => $randomTime,
                    'user_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }

    private function getAvailableDates()
    {
        $startDate = new DateTime('2023-05-01');
        $endDate = new DateTime('2023-12-31');
        $availableDates = [];

        while ($startDate <= $endDate) {
            $dayOfWeek = $startDate->format('l');
            if ($dayOfWeek === 'Monday' || $dayOfWeek === 'Wednesday' || $dayOfWeek === 'Friday') {
                $availableDates[] = $startDate->format('Y-m-d');
            }
            $startDate->add(new DateInterval('P1D'));
        }

        return $availableDates;
    }
}
