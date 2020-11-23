<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Repositories\User\UserRepositoryInterface;
use Hash;

class RegisterController extends Controller
{
    protected $user;

    function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    public function getRegister()
    {
        return view('users.pages.register');
    }

    public function postRegister(RegisterRequest $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => config('role.user'),
            'status' => config('user.status.on'),
        ];
        if ($this->user->create($data) ){
            return redirect()->route('user.getLogin');
        }
        alert(trans('message_errors'));

        return redirect()->back();
    }
}
