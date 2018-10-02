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
                'description' => 'Unlimited searches',
                'gateway_id' => 'basic_month',
                'price' => 1.99,
                'active' => true,
                'teams_enabled' => false,
                'teams_limit' => null,
                'recurring' => 'monthly'
            ],

            [
                'name' => 'Basic Locator',
                'slug' => 'basic-yearly',
                'description' => 'Unlimited searches',
                'gateway_id' => 'basic_year',
                'price' => 19.99,
                'active' => true,
                'teams_enabled' => false,
                'teams_limit' => null,
                'recurring' => 'yearly'
            ],

            [
                'name' => 'Superior Locator',
                'slug' => 'super-monthly',
                'description' => 'Unlimited searches. View one call information Section, Range, Township, .etc when available. You can append/override location info. Changes and original data will be viewable.',
                'gateway_id' => 'super_month',
                'price' => 3.99,
                'active' => true,
                'teams_enabled' => false,
                'teams_limit' => null,
                'recurring' => 'monthly'
            ],

            [
                'name' => 'Superior Locator',
                'slug' => 'super-yearly',
                'description' => 'Unlimited searches. View one call information Section, Range, Township, .etc when available. You can append/override location info. Changes and original data will be viewable.',
                'gateway_id' => 'super_year',
                'price' => 39.99,
                'active' => true,
                'teams_enabled' => false,
                'teams_limit' => null,
                'recurring' => 'yearly'
            ],
        ];

        $teamPlans = [
            [
                'name' => 'Team 10',
                'slug' => 'team-monthly-10',
                'description' => '10 Team members will have access to use the website and mobile application. 
                    Team members can append/override location info. Changes and original data will be viewable. 
                    One call information such as Section, Range, Township, etc. will be displayed when available.',
                'gateway_id' => 'team_month_10',
                'price' => 29.99,
                'active' => true,
                'teams_enabled' => true,
                'teams_limit' => 10,
                'recurring' => 'monthly'
            ],

            [
                'name' => 'Team 10',
                'slug' => 'team-yearly-10',
                'description' => '10 Team members will have access to use the website and mobile application. 
                    Team members can append/override location info. Changes and original data will be viewable. 
                    One call information such as Section, Range, Township, etc. will be displayed when available.',
                'gateway_id' => 'team_year_10',
                'price' => 299.99,
                'active' => true,
                'teams_enabled' => true,
                'teams_limit' => 10,
                'recurring' => 'yearly'
            ],

            [
                'name' => 'Team 20',
                'slug' => 'team-monthly-20',
                'description' => '20 Team members will have access to use the website and mobile application. 
                    Team members can append/override location info. Changes and original data will be viewable. 
                    One call information such as Section, Range, Township, etc. will be displayed when available.',
                'gateway_id' => 'team_month_20',
                'price' => 59.99,
                'active' => true,
                'teams_enabled' => true,
                'teams_limit' => 20,
                'recurring' => 'monthly'
            ],

            [
                'name' => 'Team 20',
                'slug' => 'team-yearly-20',
                'description' => '20 Team members will have access to use the website and mobile application. 
                    Team members can append/override location info. Changes and original data will be viewable. 
                    One call information such as Section, Range, Township, etc. will be displayed when available.',
                'gateway_id' => 'team_year_20',
                'price' => 599.99,
                'active' => true,
                'teams_enabled' => true,
                'teams_limit' => 20,
                'recurring' => 'yearly'
            ],

        ];

        Plan::insert($plans);
        Plan::insert($teamPlans);
    }
}
