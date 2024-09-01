<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use app\Models\users;

class DatabaseSelectTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
       // Menyiapkan data pengguna menggunakan factory
       Users::factory()->count(3)->create();

       // Mengambil semua data pengguna dari database
       $users = Users::all();

       // Memastikan jumlah pengguna yang diambil sesuai dengan yang dibuat
       $this->assertCount(10, $users);

       // Memastikan data yang diambil sesuai dengan yang diharapkan
       $users->each(function ($user) {
           $this->assertDatabaseHas('users', [
               'id' => $user->id,
               'email' => $user->email,
               'username' => $user->username,
               'password' => $user->password,
           ]);
       });
   
    }
}
