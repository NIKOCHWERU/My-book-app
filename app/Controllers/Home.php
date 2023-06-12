<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $data = [];

        $auth = service('authentication');

        // Cek apakah pengguna sedang login
        $isLoggedIn = $auth->check();

        if ($isLoggedIn) {
            // Mendapatkan objek pengguna saat ini
            $currentUser = $auth->user();

            $data['username'] = $currentUser->username;
            $data['img'] = $currentUser->img;
        }

        // Load view dengan data 
        return view('books', [
            'isLoggedIn' => $isLoggedIn,
            'user' => $data,
            'title' => 'Home'
        ]);
    }
    public function aboutMe()
    {
        $data = [];

        $auth = service('authentication');

        // Cek apakah pengguna sedang login
        $isLoggedIn = $auth->check();

        if ($isLoggedIn) {
            // Mendapatkan objek pengguna saat ini
            $currentUser = $auth->user();

            $data['username'] = $currentUser->username;
            $data['img'] = $currentUser->img;
        }

        // Load view dengan data 
        return view('about_me', [
            'isLoggedIn' => $isLoggedIn,
            'user' => $data,
            'title' => 'About Me'
        ]);
    }
}
