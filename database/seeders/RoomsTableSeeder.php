<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Building;
use App\Models\Block;
use App\Models\RoomCategory; // Assuming you have a RoomCategory model

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create some buildings
        $building = Building::create(['name' => 'Building A']);
        $block = Block::create(['building_id' => $building->id, 'block_name' => 'Block A1']);

        // Assuming you have 4 storeys and each storey has 20 rooms
        for ($storeyNumber = 1; $storeyNumber <= 4; $storeyNumber++) {
            for ($roomNumber = 0; $roomNumber < 20; $roomNumber++) {
                Room::create([
                    'building_id' => $building->id, // Link to the building
                    'room_no' => 200 + ($storeyNumber - 1) * 20 + $roomNumber + 1,
                    'room_category_id' => 1, // Assuming a default category ID
                    'description' => 'Room ' . (200 + ($storeyNumber - 1) * 20 + $roomNumber + 1),
                    'room_charge' => 100.00, // Default room charge
                    'number_of_members' => 1, // Default number of members
                    'image_path' => null, // Default image path
                ]);
            }
        }
    }
}