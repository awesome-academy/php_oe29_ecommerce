<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepo, $roleRepo;

    function __construct(UserRepositoryInterface $user, RoleRepositoryInterface $roleRepo)
    {
        $this->userRepo = $user;
        $this->roleRepo = $roleRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepo->getAll();
        $roles = $this->roleRepo->getAll()->where('id', '!=', config('role.admin.management'));
        $users->load('role');

        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $path =  public_path(config('setting.user_image'));
            $file->move($path, $name);
        } else {
            $name = config('setting.image.user1');
        }

        $data = [
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'role_id' => $request->role,
            'avatar' => $name,
            'status' => 1,
            'password' => config('setting.password_default'),
        ];
        $this->userRepo->create($data);

        return redirect()->back()->with('message', trans('message_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userRepo->find($id);
        if ($user) {
            $data = [
                'status' => config('setting.http_status.success'),
                'name' => $user->name,
                'address' => $user->address,
                'phone' => $user->phone,
                'email' => $user->email,
                'role' => $user->role_id,
                'route' => route('users.update', $user->id),
            ];

            return json_encode($data);
        }
        $data = [
            'status' => config('setting.http_status.error'),
            'message' => trans('message_error'),
        ];

        return json_encode($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = $this->userRepo->find($id);
        if ($user) {
            $data = [
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
                'phone' => $request->phone,
                'role_id' => $request->role,
                'status' => 1,
            ];
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $name = time() . '_' . $file->getClientOriginalName();
                $path = public_path(config('setting.user_image'));
                if ($user->avatar != config('setting.image.user1') && !empty($user->avatar)) {
                    if (file_exists(config('setting.user_image') . $user->avatar)) {
                        unlink(config('setting.user_image') . $user->avatar);
                    }
                }
                $data['avatar'] = $name;
                $file->move($path, $name);
            }
            $this->userRepo->update($id, $data);
        }

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

    }
}
