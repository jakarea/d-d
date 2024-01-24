<?php

namespace App\Http\Controllers;

use App\Models\AppBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class AppBannerController extends Controller
{
    public function index()
    {

        $banners = AppBanner::all();

        return view('banner/index', compact('banners'));
    }

    public function store(Request $request)
    {
        // return $request->all();

        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'banner_type' => 'required|in:guest,client,company',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,bmp,webp,svg|max:2048',
        ]);

        // Check for validation errors
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Failed to uploaded banner!');
        }

        // Process banner
        $banner = $request->file('banner');

        $resizedImage = Image::make($banner)
            ->resize(335, 152)
            ->encode('jpg', 80);

        $directory = 'public/uploads/banner';
        $filename = uniqid('icon_') . '.jpg';
        $resizedImage->save($directory . '/' . $filename);

        // Construct the full URL
        $url = asset($directory . '/' . $filename);

        AppBanner::updateOrCreate(
            ['banner_type' => $request->input('banner_type')],
            [
                'banner' => $url,
                'created_by' => Auth::id(),
            ]
        );

        return redirect()->back()->with('success', 'Banner uploaded successfully!');
    }
}
