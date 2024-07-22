<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('users')->insert([
            [
                'name' => 'Muhammad Tariq',
                'email' => 'saaim01@gmail.com',
                'password' => '$2y$12$L2KOuUpth.QzPslprcBoRu0nVbcNJIAbruP4h7BmhGiAFTpxmr5KK',
                'status' => true,
                'role_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Abid Javaid',
                'email' => 'abid@iub.edu.pk',
                'password' => '$2y$12$L2KOuUpth.QzPslprcBoRu0nVbcNJIAbruP4h7BmhGiAFTpxmr5KK',
                'status' => true,
                'role_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Abdullah Abid',
                'email' => 'abdrps2004@gmail.com',
                'password' => '$2y$12$L2KOuUpth.QzPslprcBoRu0nVbcNJIAbruP4h7BmhGiAFTpxmr5KK',
                'status' => true,
                'role_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
