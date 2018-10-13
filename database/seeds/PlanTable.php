<?php

use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'name' => 'Basic Locator',
                'slug' => 'basic-monthly',
                'gateway_id' => 'basic_month',
                'price' => 3.99,
                'active' => true,
                'teams_enabled' => false,
                'teams_limit' => null,
                'recurring' => 'monthly'
            ],

            [
                'name' => 'Basic Locator',
                'slug' => 'basic-yearly',
                'gateway_id' => 'basic_year',
                'price' => 39.99,
                'active' => true,
                'teams_enabled' => false,
                'teams_limit' => null,
                'recurring' => 'yearly'
            ],

            [
                'name' => 'Superior Locator',
                'slug' => 'superior-monthly',
                'gateway_id' => 'superior_month',
                'price' => 5.99,
                'active' => true,
                'teams_enabled' => false,
                'teams_limit' => null,
                'recurring' => 'monthly'
            ],

            [
                'name' => 'Superior Locator',
                'slug' => 'superior-yearly',
                'gateway_id' => 'superior_year',
                'price' => 59.99,
                'active' => true,
                'teams_enabled' => false,
                'teams_limit' => null,
                'recurring' => 'yearly'
            ],
        ];

        $teamPlans = [
            [
                'name' => 'Team Locator',
                'slug' => 'team-monthly',
                'gateway_id' => 'team_month',
                'price' => 6.99,
                'active' => true,
                'teams_enabled' => true,
                'teams_limit' => 10,
                'recurring' => 'monthly'
            ],

            [
                'name' => 'Team Locator',
                'slug' => 'team-yearly',
                'gateway_id' => 'team_year',
                'price' => 69.99,
                'active' => true,
                'teams_enabled' => true,
                'teams_limit' => 10,
                'recurring' => 'yearly'
            ],
        ];

        Plan::insert($plans);
        Plan::insert($teamPlans);
    }
}
