<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\ChangeInformationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Alert;

class HomeController extends Controller
{
    protected $userRepo;
    protected $productRepo;

    function __construct(UserRepositoryInterface $user, ProductRepositoryInterface $product)
    {
        $this->userRepo = $user;
        $this->productRepo = $product;
    }

    public function home()
    {
        $products = $this->productRepo->getLasted();

        return view('users.pages.home', compact('products'));
    }

    public function changeInformation(ChangeInformationRequest $request)
    {
        $id = Auth::user()->id;
        $data = [
            'name' => $request->username,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
        $this->userRepo->update($id, $data);
        alert()->success(trans('user.sweetalert.updated'), trans('user.sweetalert.change_information'));

        return redirect()->route('user.home')->with('message_success', trans('message_success'));
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();
        $id = $user->id;
        if (Hash::check($request->old_password, $user->password)) {
            $data = [
                'password' => bcrypt($request->new_password),
            ];
            $this->userRepo->update($id,$data);
            alert()->success(trans('user.sweetalert.updated'), trans('user.sweetalert.change_password'));

            return redirect()->route('user.home')->with('message_success', trans('message_success'));
        } else {

            return redirect()->route('user.home')->withErrors(['show_modal' => $request->define, 'old_password' => trans('wrong_password')]);
        }
    }
}
