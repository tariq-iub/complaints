<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplaintCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['title' => 'Technical Issues', 'description' => 'Software bugs,Hardware malfunctions,Connectivity issues,System downtime'],
            ['title' => 'Customer Service', 'description' => 'Poor service quality,Unprofessional behavior,Delayed response times,Miscommunication'],
            ['title' => 'Billing and Payments', 'description' => 'Incorrect billing,Payment issues,Refund requests,Overcharges'],
            ['title' => 'Product Quality', 'description' => 'Defective products,Quality not as advertised,Warranty issues'],
            ['title' => 'Delivery and Logistics', 'description' => 'Late delivery,Lost shipments,Incorrect items delivered'],
            ['title' => 'Account Management', 'description' => 'Account access issues,Unauthorized transactions,Privacy concerns'],
            ['title' => 'Fraud and Security', 'description' => 'Suspicious activity,Data breaches,Phishing attempts'],
            ['title' => 'Compliance and Legal', 'description' => 'Breach of terms and conditions,Legal concerns,Regulatory non-compliance'],
            ['title' => 'Feedback and Suggestions', 'description' => 'Service improvement suggestions,General feedback,Feature requests'],
            ['title' => 'Employee Conduct', 'description' => 'Harassment,Discrimination,Misconduct'],
            ['title' => 'Environment and Safety', 'description' => 'Workplace hazards,Environmental concerns,Health and safety violations'],
            ['title' => 'Facilities and Maintenance', 'description' => 'Cleanliness issues,Maintenance requests,Facility damage'],
            ['title' => 'Public Relations', 'description' => 'Media complaints,Public perception issues,Social media complaints'],
        ];

        DB::table('categories')->insert($categories);
    }
}
