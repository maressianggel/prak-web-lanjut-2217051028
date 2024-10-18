<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\User;
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
    $request->validate([
        'nama' => 'required|string|max:255',
        'npm' => 'required|string|max:255',
        'kelas_id' => 'required|integer',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Meng-handle upload foto
    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');
        
        // Membuat nama file yang unik dengan menambahkan timestamp dan nama asli file
        $filename = time() . '_' . $foto->getClientOriginalName();

        // Menyimpan file foto langsung di folder 'public/uploads/img'
        $fotoPath = $foto->move(public_path('upload/img'), $filename);
    } else {
        // Jika tidak ada file yang diupload, set fotoPath menjadi null atau default
        $fotoPath = null;
    }

    // Menyimpan data ke database termasuk path foto
    $this->userModel->create([
        'nama' => $request->input('nama'),
        'npm' => $request->input('npm'),
        'kelas_id' => $request->input('kelas_id'),
        'foto' => $fotoPath ? 'upload/img/' . $filename : null, // Menyimpan path foto
    ]);

    return redirect()->to('/users')->with('success', 'User berhasil ditambahkan');
    }

    public function show($id){
        $user = $this->userModel->getUser($id) ;
        $data = [
            'title' => 'Profile',
            'user'  => $user,
        ];

        return view('profile', $data);
    }
}