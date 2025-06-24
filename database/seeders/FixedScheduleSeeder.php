<?php

namespace Database\Seeders;

use App\Enums\RoomDictionary;
use App\Models\FixedSchedule;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class FixedScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (RoomDictionary::values() as $roomName) {
            $room = Room::query()->where('name', $roomName)->firstOrFail();
            $now = Carbon::now();
            $schedule = array_map(function($schedule) use ($room, $now) {
                return [
                    'room_id' => $room->id,
                    'start_at' => $schedule['start_at'],
                    'end_at' => $schedule['end_at'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }, $this->getFixedScheduleByRoomName($roomName));

            FixedSchedule::query()->insert($schedule);
        }
    }

    private function getFixedScheduleByRoomName(string $roomName): array
    {
        return match($roomName) {
            RoomDictionary::ALICE_IN_WONDERLAND->value => [
                [
                    'start_at' => '10:00',
                    'end_at' => '11:00'
                ],
                [
                    'start_at' => '11:30',
                    'end_at' => '12:30'
                ],
                [
                    'start_at' => '13:00',
                    'end_at' => '14:00'
                ],
                [
                    'start_at' => '14:30',
                    'end_at' => '15:30'
                ],
                [
                    'start_at' => '16:00',
                    'end_at' => '17:00'
                ],
            ],

            RoomDictionary::CASINO_ROYALE->value => [
                [
                    'start_at' => '09:00',
                    'end_at' => '10:00'
                ],
                [
                    'start_at' => '10:30',
                    'end_at' => '11:30'
                ],
                [
                    'start_at' => '12:00',
                    'end_at' => '13:00'
                ],
                [
                    'start_at' => '13:30',
                    'end_at' => '14:30'
                ],
                [
                    'start_at' => '15:00',
                    'end_at' => '16:00'
                ],
            ],

            RoomDictionary::TIME_TRAVEL->value => [
                [
                    'start_at' => '08:00',
                    'end_at' => '09:00'
                ],
                [
                    'start_at' => '09:30',
                    'end_at' => '10:30'
                ],
                [
                    'start_at' => '11:00',
                    'end_at' => '12:00'
                ],
                [
                    'start_at' => '12:30',
                    'end_at' => '13:30'
                ],
                [
                    'start_at' => '14:00',
                    'end_at' => '15:00'
                ],
            ],
        };
    }
}
