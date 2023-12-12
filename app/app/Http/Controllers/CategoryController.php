<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Traits\SlugTrait;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryAddRequest;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Auth;
class CategoryController extends Controller
{
    use SlugTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $categories = Category::paginate(16); 
        return view('category/index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryAddRequest $request)
    {

        $name = $request->input('name');
        // Ensure the slug is unique
        $slug = $this->makeUniqueSlug($name,'Category');

        $icon = $request->file('icon');
        // Resize and compress the image
        $resizedImage = Image::make($icon)
            ->resize(100, 100) // Adjust dimensions as needed
            ->encode('jpg', 80); // Adjust quality as needed

        // Define the directory and file name
        $directory = 'public/uploads/category'; // Add 'public/' before 'uploads/'
        $filename = uniqid('icon_') . '.jpg'; // You can adjust the file extension

        // Save the resized and compressed image to the desired location
        $resizedImage->save($directory . '/' . $filename);

        // Construct the full URL
        $url = asset($directory . '/' . $filename);

    
        $category = Category::create([
            'name' => $request->input('name'),
            'slug' => $slug,
            'icon' => $url,
            'created_by' => Auth::id()
        ]);

        $status = 'success';
        $message = 'Successfully added a new category!';

        return redirect()->route('category.index')->with($status, $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
