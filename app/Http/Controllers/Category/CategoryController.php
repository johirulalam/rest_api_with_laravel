<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Category;

class CategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $category = Category::all();
        return $this->showAll($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
        return $this->showOne($category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|unique:categories|max:40',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        return $this->showOne($category);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        //
        $request->validate([
            'name' => 'required|max:50|unique:categories,name,'.$category->id,
        ]);

        if ($request->has('name')) {
            $category->name = $request->name;
        }
        if ($request->has('description')) {
            $category->description = $request->description;
        }
        if (!$category->isDirty) {
            return $this->errorResponse(['error' => 'You need to specifywhich feild you want to change']);
        }

        $category->save();
        return $this->showOne($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        //
        $category->delete();
        return $this->showOne($category);
    }
}
