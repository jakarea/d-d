<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PricingPackage;
use Auth;

class PricingPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        PricingPackage::updateOrCreate([
            'id' => 1,
        ], [
            'name' => 'Monthly Plan',
            'slug' => 'monthly-plan',
            'price' => '45',
            'status' => 'active',
            'is_featured' => 1,
            'created_by' => 1,
            'package_type' => 'Monthly',
            'features' => json_encode([
                'feat1' => 'Cost-Effective Promotion',
                'feat2' => 'Targeted Local Reach',
                'feat3' => 'User-Friendly Platform',
                'feat4' => 'Increased Customer Engagement',
                'feat5' => 'No Ad Hassles',
            ]),
        ]);


        PricingPackage::updateOrCreate([
            'id' => 2,
        ], [
            'name' => 'Yearly Plan',
            'slug' => 'yearly-plan',
            'price' => '450',
            'status' => 'active',
            'is_featured' => 0,
            'created_by' => 1,
            'package_type' => 'Yearly',
            'features' => json_encode([
                'feat1' => 'Cost-Effective Promotion',
                'feat2' => 'Targeted Local Reach',
                'feat3' => 'User-Friendly Platform',
                'feat4' => 'Increased Customer Engagement',
                'feat5' => 'No Ad Hassles',
            ]),
        ]);
    }
}
