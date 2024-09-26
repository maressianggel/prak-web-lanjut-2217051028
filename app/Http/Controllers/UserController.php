<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\kelas;
use App\Models\UserModel;

class UserController extends Controller
{

    public function create(){ 
        return view('create_user', ['kelas' => kelas::all(),]); 
        
        
        } 



    public function store(Request $request){
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

        $user -> load ('kelas');

        return view ('profile', [
            'nama' => $user->nama,
            'npm' => $user -> npm,
            'nama_kelas' => $user->kelas->nama_kelas ?? 'Kelas tidak ditemukan',
        ]);
    }
}