<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Http\Requests\CreateBrandRequest;
use App\Http\Requests\EditBrandRequest;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\Brand\BrandRepository;

class BrandController extends Controller
{
    protected $brandRepo;

    public function __construct(BrandRepositoryInterface $brandRepo)
    {
        $this->brandRepo = $brandRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = $this->brandRepo->getAll();

        return view('admin.brands.list', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBrandRequest $request)
    {
        $this->brandRepo->create([
            'name' => $request->name_of_create,
        ]);

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditBrandRequest $request, $id)
    {
        $this->brandRepo->update($id, [
            'name' => $request->name_of_edit,
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->brandRepo->delete($id);

        return redirect()->back();
    }
}
