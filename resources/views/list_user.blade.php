@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-30"> <!-- Kolom lebar -->
            <div class="card">
                <div class="card-header text-center">
                    <h1 class="mb-30">Daftar Pengguna</h1>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered text-center" style="width: 1200px;"> <!-- Mengatur lebar tabel dan teks di tengah -->
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>NPM</th>
                                <th>Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->npm }}</td>
                                    <td>{{ $user->kelas->nama_kelas ?? 'Kelas Tidak Ditemukan' }}</td>
                                    <td>
                                         <div class="d-flex justify-content-center"> <!-- Menambahkan div flex untuk mengatur posisi -->
                                            <a href="#" class="btn btn-sm btn-secondary me-5" onclick="return false;">Edit</a> <!-- Menambahkan margin kanan -->
                                            <form action="#" method="POST" class="d-inline" onsubmit="return false;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger me-3">Delete</button>
                                            </form>
                                    </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-3">
                        <a href="{{ route('user.create') }}" class="btn btn-info btn-block" style="background-color: #ffcccb; color: black;">Tambah Pengguna Baru</a> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
