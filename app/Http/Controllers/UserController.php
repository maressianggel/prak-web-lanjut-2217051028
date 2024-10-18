<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\UserModel;

class UserController extends Controller
{
    public $userModel;
    public $kelasModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->kelasModel = new Kelas();
    }

    public function index()
    {
        // Mengambil semua data user dan menampilkannya dalam view
        $data = [
            'title' => 'Daftar Pengguna',
            'users' => $this->userModel->getUser(), 
        ];

        return view('list_user', $data);
    }

    public function create()
    {
        // Mengambil data kelas untuk ditampilkan dalam form
        $kelas = $this->kelasModel->all();
        return view('create_user', ['kelas' => $kelas]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:255',
            'kelas_id' => 'required|exists:kelas,id',
        ], [
            'nama.required' => 'The Nama field is required.',
            'npm.required' => 'The NPM field is required.',
            'kelas_id.required' => 'The Kelas field is required.',
            'kelas_id.exists' => 'The selected Kelas is invalid.',
        ]);

        $user = UserModel::create($validatedData);
        $user->load('kelas');
        return view('profile',[
            'nama' => $user->nama,
            'npm' => $user->npm,
            'nama_kelas' => $user ->kelas->nama_kelas ?? 'Kelas Tidak Ditemukan',
        ]);

        // Menyimpan data pengguna
        $this->userModel->create($validatedData);
        return redirect()->to('/users');

    }
}