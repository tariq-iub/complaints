<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FactoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('factories')->insert([
            [
                'title' => 'Factory 1',
                'address' => 'The Islamia University of Bahawalpur, Pakistan',
                'owner_name' => 'Abid Javaid',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        DB::table('sites')->insert([
            [
                'title' => 'Powder Plant',
                'factory_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Amonia Plant',
                'factory_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'UHT Hall',
                'factory_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Pasteurizer Hall',
                'factory_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'PLE Hall',
                'factory_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Juice Hall',
                'factory_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Tetra Pack',
                'factory_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Technical Block',
                'factory_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Admin Block',
                'factory_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Power House',
                'factory_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Instrument Lab',
                'factory_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}


