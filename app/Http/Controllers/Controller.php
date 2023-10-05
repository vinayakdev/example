<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function view()
    {
        return view('mailings');
    }

    public function simple()
    {
        \Illuminate\Support\Facades\DB::transaction(function () {
            $this->createUser();
            $this->createProfile();
        });

        dump(\App\Models\User::latest()->get()->count());
        dump(\App\Models\Profile::latest()->get()->count());
        // \Illuminate\Support\Facades\Artisan::call("migrate:fresh");
    }

    public function complex()
    {
        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            $this->createUser();
            $this->createProfile();
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollback();
            \Illuminate\Support\Facades\Log::info($e);
            dump($e);
        }

        \Illuminate\Support\Facades\DB::commit();

        dump('User: ' . \App\Models\User::count());
        dump('Profile: ' . \App\Models\Profile::count());

        // \Illuminate\Support\Facades\Artisan::call("migrate:fresh");
    }

    public function createUser()
    {
        $user = \App\Models\User::create([
            'name' => fake()->name(),
            'email' => fake()->email(),
            'password' => bcrypt('asdfghjkl')
        ]);
        dump($user->toArray());
    }

    public function createProfile()
    {
        $profile = \App\Models\Profile::create([
            'full_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'status' => 1,
            // 'status' => 'sd'
        ]);
        dump($profile->toArray());
    }
}
