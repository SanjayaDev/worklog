<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Property for user service
     * 
     */
    private $user_service;

    /**
     * Constructor for load service
     * 
     */
    public function __construct()
    {
        $this->user_service = new UserService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            "users" => $this->user_service->get_paginate()
        ];

        return $this->view_admin("users.index", "User Management", $data, TRUE);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            "roles" => Role::where("id", ">", 1)->get()
        ];
        return $this->view_admin("users.create", "Create User", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = $this->user_service->store_user($request);
        if ($user) {
            Alert::success("Sukses!", "User berhasil ditambahkan");
            return redirect("/dashboard/users/$user");
        }
        
        Alert::error("Gagal!", "Gagal menambahkan! Silahkan coba kembali!");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            "user" => $this->user_service->get_by_id($id)
        ];

        return $this->view_admin("users.show", "User Detail", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            "user" => $this->user_service->get_by_id($id),
            "roles" => Role::where('id', '>', 1)->get()
        ];

        return $this->view_admin("users.edit", "Edit User", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = $this->user_service->update_user($request, $id);
        if ($user) {
            Alert::success("Sukses!", "User berhasil ditambahkan");
            return redirect("/dashboard/users/$id");
        }
        Alert::success("Sukses!", "User gagal diupdate! Silahkan coba kembali!");
        return redirect("/dashboard/users/$id");
    }
}
