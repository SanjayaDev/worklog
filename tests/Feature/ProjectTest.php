<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    /**
     * Test create project
     * 
     */
    public function test_project_create()
    {
        $user = Auth::loginUsingId(1);
        $this->actingAs($user, "web");

        $response = $this->post("/dashboard/projects", [
            "project_name" => "Web Worklog",
            "project_description" => "cPanel akun https://worklog.test/cpanel",
            "user_id" => [
                1,
                2
            ]
        ]);

        $response->assertRedirect("/dashboard/projects/1");
    }

    /**
     * Test edit project
     * 
     */
    public function test_project_edit()
    {
        $user = Auth::loginUsingId(1);
        $this->actingAs($user, "web");

        $response = $this->put("/dashboard/projects/1", [
            "id" => 1,
            "project_name" => "Web Worklog 2",
            "project_description" => "cPanel akun https://worklog.test/cpanel",
            "user_id" => [
                1
            ]
        ]);

        $response->assertRedirect("/dashboard/projects/1");
    }
}
