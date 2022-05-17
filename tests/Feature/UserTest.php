<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * Test create user with invalid data
     * 
     */
    public function test_create_user_invalid()
    {
        // $this->withoutExceptionHandling();

        $this->actingAs(Auth::loginUsingId(1), "web");

        $response = $this->post("/dashboard/users", [
            "name" => "",
            "email" => "",
            "password" => "",
            "is_super_admin" => "",
        ]);

        // $response->assertStatus("422");
        $response->assertSessionHasErrors(["name", "email", "password"]);
    }

    /**
     * Test create user
     * 
     */
    public function test_user_su_create_user()
    {
        $user = Auth::loginUsingId(1);

        $response = $this->actingAs($user, "web")
            ->post("/dashboard/users", [
                "name" => "Test User",
                "email" => "test3@gmail.com",
                "password" => "admin123",
                "is_super_admin" => 1,
            ]);

        $response->assertStatus(302);
    }

    /**
     * Test user no super user create user
     * 
     */
    public function test_user_no_su_create_user()
    {
        $user = Auth::loginUsingId(8);

        $response = $this->actingAs($user, "web")
            ->post("/dashboard/users", [
                "name" => "Test User",
                "email" => "test2@gmail.com",
                "password" => "admin123",
                "is_super_admin" => 1
            ]);

        $response->assertStatus(302);
    }

    /**
     * test validation update user
     * 
     */
    public function test_validation_update_user()
    {
        $user = Auth::loginUsingId(1);

        $this->actingAs($user, "web");

        $response = $this->put("/dashboard/users/8", [
            "name" => "",
            "email" => "",
            "password" => "",
            "is_super_admin" => "",
        ]);

        $response->assertInvalid();
    }

    /**
     * Test user su update user
     * 
     */
    public function test_user_su_update_user()
    {
        $user = Auth::loginUsingId(1);

        $this->actingAs($user, "web");

        $response = $this->put("/dashboard/users/8", [
            "name" => "Test User Anjass",
            "id" => 8
        ]);

        $response->assertRedirect("/dashboard/users/8");
    }
}
