<?php

namespace App\Process;

use App\Http\Requests\Category\StoreRequest;
use App\Models\Category;
use App\Traits\FileTrait;
use App\Traits\SlugTrait;

class CategoryProcess{

    use SlugTrait, FileTrait;

    public static function create(StoreRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->slug = (new self())->makeUniqueSlug($request->name,'Category');
        $category->created_by = auth()->user()->id;

        if ($request->file('icon') != null) {

            $fileName = (new self())->fileUpload($request, "icon", "public/icons");
            $filePath = asset('storage/icons/' . $fileName);
            $category->icon = $fileName;
        }
        $category->save();

        $category->icon =  asset('storage/icons/' . $category->icon);

        return $category;
    }
}
