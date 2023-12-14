<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\SlugTrait;
use App\Models\PricingPackage;
use Illuminate\Support\Facades\Artisan;
use Auth;

class PackageController extends Controller
{
    use SlugTrait;

    public function index(){

        $packages = PricingPackage::get(); 

        if (count($packages) <= 0) {  
            Artisan::call('db:seed', ['--class' => 'PricingPackageSeeder']);
        }

        return view('packages/index',compact('packages'));
    }

    public function edit(){

        $packages = PricingPackage::get();

        if (count($packages) <= 0) { 
            Artisan::call('db:seed', ['--class' => 'PricingPackageSeeder']);
        } 

        if ($packages && count($packages) > 0) {
            $packageOne = $packages[0];
            $packageOneFeatures = json_decode($packageOne->features);

            $packageTwo = $packages[1];
            $packageTwoFeatures = json_decode($packageTwo->features);

            $packageThree = $packages[2];
            $packageThreeFeatures = json_decode($packageThree->features);
        }
 
        return view('packages.edit',compact('packageOne','packageTwo','packageThree','packageOneFeatures','packageTwoFeatures','packageThreeFeatures'));

    }

    public function update(Request $request, $id)
    { 

        $request->validate([
            'name' => 'required|string', 
            'price' => 'required|string',
            'package_type' => 'required|string'
        ]);

        $pricingPackage = PricingPackage::find($request->package_id);

        if (!$pricingPackage) { 
            return redirect()->route('pricing.packages')->with('error', 'Pricing package not found.');
        }

        $features = $request->input('features');
        $featuresArray = [];

        foreach ($features as $index => $feature) {
            $key = 'feat' . ($index + 1);
            $trimmedFeature = $feature !== null ? trim($feature) : null;
            $featuresArray[$key] = $trimmedFeature;
        }
         
        $featuresArray = array_filter($featuresArray, function ($value) {
            return $value !== null;
        });       
 
        $pricingPackage->update([
            'name' => $request->input('name'),
            'slug' => $this->makeUniqueSlug($request->name,'PricingPackage',$request->slug),
            'price' => $request->input('price'),
            'yearly_price' => $request->input('yearly_price'),
            'package_type' => $request->input('package_type'),
            'features' => json_encode($featuresArray),
            'status' => 'active',
            'is_featured' => $request->input('is_featured'),
            'created_by' => Auth::id(),
        ]); 
 
        return redirect()->route('pricing.packages')->with('success', 'Pricing package updated successfully.');
    }
}
