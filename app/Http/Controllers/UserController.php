<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            "users" => User::paginate(15)
        ];

        return \view("admin.users.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $is_super_admin = 0;
        if (Auth::user()->is_super_admin) {
            $is_super_admin = isset($request->is_super_admin) ? 1 : 0;
        }

        $values = $request->validated();
        $values["is_super_admin"] = $is_super_admin;
        $values["password"] = Hash::make($values["password"]);

        $user = User::create($values);

        Alert::success("Sukses!", "User berhasil ditambahkan");
        return redirect("/dashboard/users/$user->id");
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $data = [
            "user" => $user
        ];

        return \view("admin.users.show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $data = [
            "user" => $user
        ];

        return \view("admin.users.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRequest $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $is_super_admin = 0;
        if (Auth::user()->is_super_admin) {
            $is_super_admin = isset($request->is_super_admin) ? 1 : 0;
        }

        $values = $request->validated();
        $values["is_super_admin"] = $is_super_admin;
        if (!empty($values["password"])) {
            $values["password"] = Hash::make($values["password"]);
        } else {
            unset($values["password"]);
        }

        $user->update($values);

        Alert::success("Sukses!", "User berhasil ditambahkan");
        return redirect("/dashboard/users/$user->id");
    }
}
