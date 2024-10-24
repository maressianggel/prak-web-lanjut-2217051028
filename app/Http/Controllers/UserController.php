<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\User;
use App\Models\UserModel;
use App\Models\Fakultas;

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
        
        $users = User::with(['kelas', 'fakultas'])->get(); 
        return view('list_user', compact('users'));
    }
    
    public function create()
    {
        $kelas = $this->kelasModel->getKelas(); // Mengambil data kelas
        $fakultas = Fakultas::all();

        $data = [
            'title' => 'Create User', 
            'kelas' => $kelas,
            'fakultas' => $fakultas,
        ];
    
        return view('create_user', $data); // Mengirim data ke tampilan
    }

    public function store(Request $request){
    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',
        'kelas_id' => 'required|integer',
        'semester' => 'required|string|max:255',
        'fakultas_id' => 'required|string|max:255',
        'jurusan' => 'required|string|max:255',
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
        'kelas_id' => $request->input('kelas_id'),
        'semester' => $request->input('semester'),
        'fakultas_id' => $request->input('fakultas_id'),
        'jurusan' => $request->input('jurusan'),
        'foto' => $fotoPath ? 'upload/img/' . $filename : null,
    ]);

    return redirect()->route(route:'users')->with('success', 'User berhasil ditambahkan');
    }

    public function show($id){
        $user = $this->userModel->getUser($id);

        if (!$user) {
            return redirect()->route('user.list')->with('error', 'User not found');
        }

        $data = [
            'title' => 'Profile',
            'nama' => $user->nama,
            'jurusan' => $user->jurusan,
            'semester' => $user->semester,
            'fakultas' => $user->fakultas->nama_fakultas,
            'kelas' => $user->kelas->nama_kelas,
            'foto' => $user->foto,
            'user' => $user
        ];

        return view('profile', $data);
    }

    public function edit($id)
    {
        $user = UserModel::findOrFail($id);
        $kelasModel = new Kelas();
        $kelas = $kelasModel->getKelas();
        $fakultas = Fakultas::all(); 
        $title = 'Edit User';
    
        return view('edit_user', compact('user', 'kelas', 'fakultas', 'title'));
    }


    public function update(Request $request,$id)
    {
        $user = UserModel::findOrFail($id);
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'jurusan' => 'required|in:fisika,kimia,biologi,matematika,ilmu komputer',
            'semester' => 'required|integer|between:1,14',
            'fakultas_id' => 'required|integer|exists:fakultas,id',
            'kelas_id' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user->nama = $request->nama;
        $user->jurusan = $request->jurusan;
        $user->semester = $request->semester;
        $user->fakultas_id = $request->fakultas_id;
        $user->kelas_id = $request->kelas_id;

        if ($request->hasFile('foto')) {
            if ($user->foto) {
                @unlink(storage_path('app/public/uploads/' . $user->foto));
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads', $filename);
            $user->foto = $filename;
        }

        $user->save();

        return redirect()->route('userS')->with('succes','User Update Succesfully');
    }

    public function destroy($id)
    {
        if ($user->foto) {
            @unlink(public_path($user->foto));
        }

        $user->delete();

        return redirect()->to('/users')->with('succes', 'User has been deleted succesfully');
    }
}