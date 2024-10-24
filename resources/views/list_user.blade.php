@extends('layouts.app')

@section('content')
<div class="container mt-5"> 
    <div class="d-flex justify-content-center"> 
        <div class="row justify-content-center">
            <div class="col-md-30"> <!-- Kolom lebar -->
                <div class="card">
                    <div class="card-header text-center">
                        <h1 class="mb-30">Daftar Pengguna</h1>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped table-bordered text-center" style="width: 1000px;"> <!-- Mengatur lebar tabel dan teks di tengah -->
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Semester</th>
                                    <th>Kelas</th>
                                    <th>Fakultas</th>
                                    <th>Jurusan</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($users)
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->nama }}</td>
                                        <td>{{ $user->semester }}</td>
                                        <td>{{ $user->kelas->nama_kelas ?? 'Kelas Tidak Ditemukan' }}</td>
                                        <td>{{ $user->fakultas->nama_fakultas ?? 'Tidak ada' }}</td>

                                        <td>
                                            @if ($user->foto) <!-- Cek jika ada foto -->
                                                <img src="{{ asset($user->foto) }}" alt="{{ $user->nama }}" style="width: 50px; height: 50px; border-radius: 50%;">
                                            @else
                                                <img src="{{ asset('path/to/default/image.jpg') }}" alt="Default" style="width: 50px; height: 50px; border-radius: 50%;">
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center"> <!-- Menambahkan div flex untuk mengatur posisi -->
                                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info px-3 py-2 mx-2">Detail</a>
                                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-secondary px-3 py-2 mx-2">Edit</a>
                                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger px-3 py-1 mx-2">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>

                        <div class="mt-3">
                            <a href="{{ route('user.create') }}" class="btn btn-primary px-3 py-3 mb-3">Tambah Pengguna Baru</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
