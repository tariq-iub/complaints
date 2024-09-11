<?php

namespace Database\Seeders;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('menus')->insert([
            [
                'title' => 'Home',
                'icon' => 'pie-chart',
                'url' => null,
                'route' => 'home',
                'parent_id' => null,
                'display_order' => 0,
                'status' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Menu Management',
                'icon' => 'layout',
                'url' => null,
                'route' => 'menus.index',
                'parent_id' => null,
                'display_order' => 1,
                'status' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Roles Management',
                'icon' => 'tool',
                'url' => null,
                'route' => 'roles.index',
                'parent_id' => null,
                'display_order' => 2,
                'status' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'User Management',
                'icon' => 'users',
                'url' => null,
                'route' => null,
                'parent_id' => null,
                'display_order' => 3,
                'status' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Users List',
                'icon' => null,
                'url' => null,
                'route' => 'users.index',
                'parent_id' => 4,
                'display_order' => 4,
                'status' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Add User',
                'icon' => null,
                'url' => null,
                'route' => 'users.create',
                'parent_id' => 4,
                'display_order' => 5,
                'status' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'User Logs',
                'icon' => null,
                'url' => null,
                'route' => 'users.user-activities',
                'parent_id' => 4,
                'display_order' => 6,
                'status' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Client Management',
                'icon' => 'server',
                'url' => null,
                'route' => null,
                'parent_id' => null,
                'display_order' => 7,
                'status' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Factories',
                'icon' => 'grid',
                'url' => null,
                'route' => 'factories.index',
                'parent_id' => 8,
                'display_order' => 9,
                'status' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Sections',
                'icon' => 'map',
                'url' => null,
                'route' => 'sections.index',
                'parent_id' => 8,
                'display_order' => 10,
                'status' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Section Handlers',
                'icon' => 'users',
                'url' => null,
                'route' => 'handlers.index',
                'parent_id' => 8,
                'display_order' => 11,
                'status' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Employees',
                'icon' => null,
                'url' => null,
                'route' => 'employees.index',
                'parent_id' => 8,
                'display_order' => 12,
                'status' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Complaints',
                'icon' => null,
                'url' => null,
                'route' => 'complaints.index',
                'parent_id' => 8,
                'display_order' => 13,
                'status' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
