<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModuleRoleRequest;
use App\Http\Requests\RoleRequest;
use App\Models\ModuleRole;
use App\Models\Role;
use App\Models\User;
use App\Services\RoleService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    /**
     * @property RoleService $role_service
     * 
     */
    private $role_service;

    public function __construct()
    {
        $this->role_service = new RoleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            "roles" => Role::all()
        ];

        return $this->view_admin("roles.index", "Role Management", $data);
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
    public function store(RoleRequest $request)
    {
        $role_id = $this->role_service->store($request);
        if ($role_id) {
            Alert::success("Succees!", "Success add new role!");
            return \redirect("/dashboard/roles/$role_id");
        }

        Alert::error("Fail!", "Have a error! Please contact you administrator!");
        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $data = [
            "role" => $role,
            "module_exists" => $this->role_service->get_module($role->id),
            "users" => User::where("role_id", $role->id)->paginate(10)
        ];

        // foreach ($data["module_exists"] as $module) {
        //     dump($module);
        // }
        // dd("MASOK");

        return $this->view_admin("roles.show", "Detail Role", $data);
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

    /**
     * Assign module to role
     * 
     * @param Request $request
     */
    public function assign_module(ModuleRoleRequest $request, Role $role)
    {
        $request = $request->validated();
        $role->module_roles()->delete();

        if (isset($request["module_id"])) {
            foreach ($request["module_id"] as $id) {
                $role->module_roles()->create([
                    "module_id" => $id
                ]);
            }
        }

        Alert::success("Sukses!", "Sukses assign role!");
        return back();
    }
}
