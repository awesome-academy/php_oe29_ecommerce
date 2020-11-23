<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Auth;

class CategoryController extends Controller
{
    protected $category;

    function __construct(CategoryRepositoryInterface $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        if (Auth::user()->can('viewAny', Category::class)) {
            $categories = $this->category->getAll();

            return view('admin.categories.list', compact('categories'));
        }
    }

    public function store(CategoryRequest $request)
    {
        if (Auth::user()->can('create', Category::class)) {
            $data = [
                'name' => $request->name,
                'parent_id' => $request->parent_id,
            ];
            if (empty($this->category->find($request->parent_id)) && $request->parent_id != null) {
                return redirect()->back()->withErrors(['show_modal' => $request->define, 'name' => trans('Category_not_found')]);
            }
            $this->category->create($data);

            return redirect()->back();
        }
    }

    public function update(CategoryRequest $request, $id)
    {
        if (Auth::user()->can('update', Category::class)) {
            $data = [
                'name' => $request->name,
                'parent_id' => $request->parent_id,
            ];
            if ($request->parent_id != null && empty($this->category->find($id))) {
                return redirect()->back()->withErrors(['show_modal' => $request->define, 'name' => trans('Category_not_found')]);
            }
            $this->category->update($id, $data);

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->can('delete', Category::class)) {
            $attribute = ['children'];
            $data = ['parent_id' => null];
            $category = $this->category->find($id, $attribute);
            if (count($category->children)) {
                foreach ($category->children as $child) {
                    $this->category->update($child->id, $data);
                }
            }
            $this->category->delete($id);

            return redirect()->back();
        }
    }
}
