<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \App\Models\UserModel;

/**
 * @author AhmadZakyHumami
 * @filesource AuthController.php
 */
class AuthController extends BaseController
{
    protected $userModel;
    
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Start Login
     */
    public function login()
    {
        // $user = $this->userModel;
        // dd($user);
        $data = [
            'title' => 'UKOM | Login',
            'validation' => \CodeIgniter\Services::validation()
        ];

        return view('auth/login', $data);
    }

    public function postlogin()
    {
        //Validasi form
        if (!$this->validate([
            'username' => [
                'rules' => 'required|min_length[5]'
            ],
            'password' => [
                'rules' => 'required|min_length[5]'
            ]
        ])) {
            return redirect()->to('/')->withInput();
        }

        //get post form input
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        //harus pake use \App\Models\UserModel; sebelum deklarasi class controller
        $users = $this->userModel;
        $user = $users->asObject()->where('username', $username)->first(); //Dijadikan object

        // var_dump($user->password);

        //Jika data tidak ada
        if ($user == NULL) {
            session()->setFlashdata('pesan', 'Username or Password not found');
            return redirect()->to('/')->withInput();
        }
        
        //Jika data ada maka cek password
        if (password_verify($password, $user->password)) {
            $data = [
                'logged_in' => true,
                'nama' => $user->nama,
                'username' => $user->username,
                'level' => $user->level,
                'id_user' => $user->id_user
            ];

            session()->set($data);
            session()->setFlashdata('pesan', 'Login Success');
            return redirect()->to('/dashboard');
        }
        
        //Jika password salah
        session()->setFlashdata('pesan', 'Username or Password was wrong');
        return redirect()->to('/')->withInput();
    }

    /**
     * Start Register
     */
    public function register()
    {
        $data = [
            'title' => 'UKOM | Register Apps',
            'validation' => \CodeIgniter\Services::validation()
        ];

        return view('auth/register', $data);
    }

    public function postregister()
    {
        //Validasi form
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|alpha_space'
            ],
            'username' => [
                'rules' => 'required|min_length[5]|is_unique[user.username]'
            ],
            'password' => [
                'rules' => 'required|min_length[5]'
            ],
            'password2' => [
                'rules' => 'required|matches[password]'
            ],
            'agree' => [
                'rules' => 'required'
            ]
        ])) {
            return redirect()->to('/register')->withInput();
        }

        // var_dump($this->request->getPost());

        $id_user = $this->request->getPost('id_user');
        $nama = $this->request->getPost('nama');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $level = $this->request->getPost('level');

        $users = $this->userModel;
        $user = $users->asObject()->where('username', $username)->first();
        
        // if ($user === NULL) {
        //     $this->userModel->save([
        //         'id_user' => ,
        //         'slug' => $slug,
        //         'author' => $this->request->getVar('author'),
        //         'publisher' => $this->request->getVar('publisher'),
        //         'cover' => $nameCover
        //     ]);
        // }
    }

    /**
     * Logout
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}