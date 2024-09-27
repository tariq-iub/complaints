<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subscriptions')->insert([
            [
                'user_id' => 1,
                'type' => 'premium',
                'stripe_id' => 'sub_1AbcdXYZ',
                'stripe_status' => 'active',
                'stripe_price' => 'price_1AbcdXYZ',
                'quantity' => 1,
                'trial_ends_at' => Carbon::now()->addDays(7),
                'ends_at' => Carbon::now()->addMonth(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'type' => 'basic',
                'stripe_id' => 'sub_2EfghIJK',
                'stripe_status' => 'canceled',
                'stripe_price' => 'price_2EfghIJK',
                'quantity' => 1,
                'trial_ends_at' => null,
                'ends_at' => Carbon::now()->subDay(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,
                'type' => 'standard',
                'stripe_id' => 'sub_3IjklLMN',
                'stripe_status' => 'past_due',
                'stripe_price' => 'price_3IjklLMN',
                'quantity' => 2,
                'trial_ends_at' => Carbon::now()->addDays(5),
                'ends_at' => Carbon::now()->addDays(20),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 4,
                'type' => 'premium',
                'stripe_id' => 'sub_4OpqrSTU',
                'stripe_status' => 'active',
                'stripe_price' => 'price_4OpqrSTU',
                'quantity' => 1,
                'trial_ends_at' => Carbon::now()->addDays(10),
                'ends_at' => Carbon::now()->addMonths(2),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 5,
                'type' => 'basic',
                'stripe_id' => 'sub_5VwxyZAB',
                'stripe_status' => 'incomplete',
                'stripe_price' => 'price_5VwxyZAB',
                'quantity' => 1,
                'trial_ends_at' => Carbon::now()->addDays(3),
                'ends_at' => Carbon::now()->addMonth(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 6,
                'type' => 'enterprise',
                'stripe_id' => 'sub_6CdefGHI',
                'stripe_status' => 'active',
                'stripe_price' => 'price_6CdefGHI',
                'quantity' => 5,
                'trial_ends_at' => Carbon::now()->addDays(14),
                'ends_at' => Carbon::now()->addMonths(6),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 7,
                'type' => 'standard',
                'stripe_id' => 'sub_7JklmNOP',
                'stripe_status' => 'trialing',
                'stripe_price' => 'price_7JklmNOP',
                'quantity' => 1,
                'trial_ends_at' => Carbon::now()->addDays(15),
                'ends_at' => Carbon::now()->addMonths(1),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}