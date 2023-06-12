<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Myth\Auth\Models\UserModel;

class Profile extends BaseController
{
    public function index()
    {
        $data = [];

        $auth = service('authentication');

        // Check if the user is currently logged in
        $isLoggedIn = $auth->check();

        if ($isLoggedIn) {
            // Get the current user object
            $currentUser = $auth->user();

            $data['username'] = $currentUser->username;
            $data['img'] = $currentUser->img;
        }

        // Load the view with the necessary data
        return view('profile', [
            'isLoggedIn' => $isLoggedIn,
            'user' => $data,
            'title' => 'Profile'
        ]);
    }

    public function updateProfile()
    {
        $auth = service('authentication');

        // Cek user login 
        if (!$auth->check()) {
            return redirect()->back()->with('error', 'You are not logged in.');
        }

        $user = $auth->user();

        // Validasi input
        if (!$this->validate([
            'username' => 'required|min_length[3]',
            'img' => 'uploaded[img]|max_size[img,1024]|ext_in[img,jpg,png]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Perbarui username jika berbeda dengan yang sebelumnya
        $newUsername = $this->request->getPost('username');
        if ($newUsername !== $user->username) {
            $userModel = new UserModel();
            $userModel->update($user->id, ['username' => $newUsername]);
        }

        // Perbarui foto profil jika ada file yang diunggah
        $profileImg = $this->request->getFile('img');
        if ($profileImg->isValid()) {
            // Hapus foto profil lama jika ada
            if ($user->img) {
                unlink(ROOTPATH . 'public/uploads/profiles/' . $user->img);
            }

            // Pindahkan file foto profil baru ke folder uploads/profiles
            $newImgName = $profileImg->getRandomName();
            $profileImg->move(ROOTPATH . 'public/uploads/profiles', $newImgName);

            // Perbarui data foto profil pengguna
            $userModel->update($user->id, ['img' => $newImgName]);
        }

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }
}
