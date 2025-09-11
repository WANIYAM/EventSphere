<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    public function run()
    {
        Event::create([
    'title' => 'Past Tech Conference',
    'description' => 'This is a past tech event.',
    'category' => 'Technical',
    'venue' => 'Auditorium A',
    'date' => now()->subDays(10)->toDateString(),
    'time' => '10:00:00',
    'status' => 'approved',
    'max_participants' => 100,
    'organizer_id' => 2, // <-- make sure user ID 1 exists
]);

    }
}
