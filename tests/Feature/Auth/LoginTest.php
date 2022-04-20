<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    // Trait refresh database agar migration dijalankan
    use RefreshDatabase;

    /** @test */
    public function registered_user_can_login()
    {
        // Kita memiliki 1 user terdaftar
        $user = factory(User::class)->create([
            'email'    => 'admin@mail.com',
            'password' => bcrypt('pass1234'),
        ]);

        // Kunjungi halaman '/login'
        $this->visit('/login');

        // Submit form login dengan email dan password yang tepat
        $this->submitForm('Login', [
            'email'    => 'admin@mail.com',
            'password' => 'pass1234',
        ]);

        // Lihat halaman ter-redirect ke url '/home' (login sukses).
        $this->seePageIs('/home');
    }
}
