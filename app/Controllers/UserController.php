<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \App\Models\UserModel;

/**
 * @author AhmadZakyHumami
 */
class UserController extends BaseController
{
    protected $userModel;
    
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    
    public function index()
    {
        $data = [
            'title' => 'UKOM | Users',
            'users' => $this->userModel->orderBy('level', 'ASC')->paginate(10, 'user'),
            'countUsers' => $this->userModel->countAll(),
            'pager' => $this->userModel->pager,
        ];

        // dd($data['users']);

        return view('pages/users/index', $data);
    }
    
    public function create()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT newkodeuser() AS id");
        $query = $query->getResultArray();
        $query = $query[0]['id'];

        $data = [
            'title' => 'UKOM | Create Users',
            'id' => $query,
            'validation' => \Config\Services::validation()
        ];

        // dd($data['users']);

        return view('pages/users/create', $data);
    }
    
    public function store()
    {
        if (!$this->validate([
            'nama' => 'required|alpha_space|max_length[225]',
            'username' => 'required|min_length[5]|max_length[50]',
            'password' => 'required|min_length[5]'
        ])) {
            return redirect()->to('dashboard/users/create')->withInput();
        }

        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('nama');
        $username = $this->request->getPost('username');
        $password = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
        $level = $this->request->getPost('level');
        
        $user = $this->userModel;
        $user = $user->asObject()->where('username', $username)->first();
        
        // dd($user);
        if ($user !== NULL) {
            session()->setFlashdata('message', 'Account Already Exist');
            return redirect()->to('/dashboard/users/create');
        }
        $this->userModel->insert([
            'id_user' => $id,
            'nama' => $nama,
            'username' => $username,
            'password'=> $password,
            'level' => $level
        ]);

        session()->setFlashdata('message', 'Account Added Successfully');
        return redirect()->to('/dashboard/users');
    }
    
    public function edit($id)
    {
        $id = $id;
        $user = $this->userModel;
        $user = $user->asObject()->where('id_user', $id)->first();
        
        $data = [
            'title' => 'UKOM | Edit Users',
            'user' => $user,
            'id' => $id,
            'validation' => \Config\Services::validation()
        ];

        // dd($user);

        if ($user === NULL) {
            session()->setFlashdata('missing', 'Account Not Found');
            return redirect()->to('/dashboard/users');
        }
        
        return view('pages/users/edit', $data);
    }
    
    public function update($id)
    {
        if (!$this->validate([
            'nama' => 'required|alpha_space|max_length[225]',
            'username' => 'required|min_length[5]|max_length[50]',
        ])) {
            return redirect()->to('dashboard/users/edit/' . $id)->withInput();
        }

        $id_user = $id;
        $nama = $this->request->getPost('nama');
        $username = $this->request->getPost('username');
        $level = $this->request->getPost('level');
        
        $user = $this->userModel;
        $user = $user->asObject()->where('id_user', $id)->first();
        
        // dd($user);
        if ($user !== NULL) {
            $this->userModel->save([
                'id_user' => $id_user,
                'nama' => $nama,
                'username' => $username,
                'level' => $level
            ]);

            session()->setFlashdata('message', 'Account Changed Successfully');
            return redirect()->to('/dashboard/users');

        }

        session()->setFlashdata('message', 'Account Not Found');
        return redirect()->to('/dashboard/users');
    }

    public function delete($id)
    {
        $this->userModel->delete($id);

        session()->setFlashdata('message', 'Account Deleted Successfully.');
        return redirect()->to('/dashboard/users');
    }
}