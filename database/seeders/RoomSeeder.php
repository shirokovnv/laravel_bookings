<?php

namespace Database\Seeders;

use App\Enums\RoomDictionary;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(RoomDictionary::values() as $roomName) {
            Room::query()->create(['name' => $roomName]);
        }
    }
}
