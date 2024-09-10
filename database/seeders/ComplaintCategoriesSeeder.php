<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComplaintCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['title' => 'Technical Issues'],
            ['title' => 'Customer Service'],
            ['title' => 'Billing and Payments'],
            ['title' => 'Product Quality'],
            ['title' => 'Delivery and Logistics'],
            ['title' => 'Account Management'],
            ['title' => 'Fraud and Security'],
            ['title' => 'Compliance and Legal'],
            ['title' => 'Feedback and Suggestions'],
            ['title' => 'Employee Conduct'],
            ['title' => 'Environment and Safety'],
            ['title' => 'Facilities and Maintenance'],
            ['title' => 'Public Relations'],
        ];

        DB::table('categories')->insert($categories);
    }
}
