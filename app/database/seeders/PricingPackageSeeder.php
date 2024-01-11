<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PricingPackage;
use Illuminate\Support\Facades\Auth; 

class PricingPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 

        $user = Auth::user();

        PricingPackage::updateOrCreate([
            'id' => '1',
        ], [
            'name' => 'Basic plan',
            'slug' => 'basic-plan',
            'price' => '10',
            'yearly_price' => '100',
            'status' => 'active',
            'is_featured' => 1,
            'created_by' => $user ? $user->id : 1,
            'package_type' => 'Yearly',
            'features' => json_encode([
                'feat1' => 'Access to all basic features',
                'feat2' => 'Basic reporting and analytics',
                'feat3' => 'Up to 10 individual users',
                'feat4' => '20GB individual data each user',
                'feat5' => 'Basic chat and email support',
            ]),
        ]);
 
        PricingPackage::updateOrCreate([
            'id' => '2',
        ], [
            'name' => 'Business plan',
            'slug' => 'business-plan',
            'price' => '20',
            'yearly_price' => '180',
            'status' => 'active',
            'is_featured' => 0,
            'created_by' => $user ? $user->id : 1,
            'package_type' => 'Yearly',
            'features' => json_encode([
                'feat1' => '200+ integrations',
                'feat2' => 'Advanced reporting and analytics',
                'feat3' => 'Up to 20 individual users',
                'feat4' => '40GB individual data each user',
                'feat5' => 'Priority chat and email support',
            ]),
        ]);
 
        PricingPackage::updateOrCreate([
            'id' => '3',
        ], [
            'name' => 'Enterprise plan',
            'slug' => 'enterprise-plan',
            'price' => '40',
            'yearly_price' => '250',
            'status' => 'active',
            'is_featured' => 0,
            'created_by' => $user ? $user->id : 1,
            'package_type' => 'Yearly',
            'features' => json_encode([
                'feat1' => 'Advanced custom fields',
                'feat2' => 'Audit log and data history',
                'feat3' => 'Unlimited individual users',
                'feat4' => 'Unlimited individual data',
                'feat5' => 'Personalised+priority service',
            ]),
        ]);
 
        PricingPackage::updateOrCreate([
            'id' => '4',
        ], [
            'name' => 'Trail plan',
            'slug' => 'trail-plan',
            'price' => '00',
            'yearly_price' => '00',
            'status' => 'trail',
            'is_featured' => 0,
            'created_by' => $user ? $user->id : 1,
            'package_type' => 'trail',
            'features' => json_encode([
                'feat1' => 'Trail has no features', 
            ]),
        ]);
    }
}
