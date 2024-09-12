<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
        $now = Carbon::now();
        $categories = [
            ['title' => 'Technical Issues', 'description' => 'Software bugs,Hardware malfunctions,Connectivity issues,System downtime', 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Customer Service', 'description' => 'Poor service quality,Unprofessional behavior,Delayed response times,Miscommunication', 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Billing and Payments', 'description' => 'Incorrect billing,Payment issues,Refund requests,Overcharges', 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Product Quality', 'description' => 'Defective products,Quality not as advertised,Warranty issues', 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Delivery and Logistics', 'description' => 'Late delivery,Lost shipments,Incorrect items delivered', 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Account Management', 'description' => 'Account access issues,Unauthorized transactions,Privacy concerns', 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Fraud and Security', 'description' => 'Suspicious activity,Data breaches,Phishing attempts', 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Compliance and Legal', 'description' => 'Breach of terms and conditions,Legal concerns,Regulatory non-compliance', 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Feedback and Suggestions', 'description' => 'Service improvement suggestions,General feedback,Feature requests', 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Employee Conduct', 'description' => 'Harassment,Discrimination,Misconduct', 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Environment and Safety', 'description' => 'Workplace hazards,Environmental concerns,Health and safety violations', 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Facilities and Maintenance', 'description' => 'Cleanliness issues,Maintenance requests,Facility damage', 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Public Relations', 'description' => 'Media complaints,Public perception issues,Social media complaints', 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('categories')->insert($categories);
    }
}
