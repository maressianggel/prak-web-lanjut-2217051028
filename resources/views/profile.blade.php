<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title> <!-- Hanya satu elemen <title> -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .profile-card {
            max-width: 600px; 
        }
        .profile-item {
            font-size: 3rem; 
            padding: 2rem 3rem;
        }
    </style>
</head>
<body class="flex items-center justify-center h-screen"  style="background: linear-gradient(to right, #FFC0CB, #FFFFFF, #E0B0FF);">

    <div class="bg-white rounded-lg shadow-lg p-6 max-w-md text-center w-full">
        <div class="w-32 h-32 mx-auto mb-4 relative">
            <!-- Menggunakan default foto jika null -->
            <img id="maress" class="rounded-full border border-gray-500 object-cover w-full h-full" 
                src="{{ $user->foto ? asset($user->foto) : asset('path/to/default-foto.jpg') }}" 
                alt="Foto{{ $user->nama }}">        
        </div>
        <div class="space-y-2">
            <!-- Menampilkan data dari $user -->
            <div class="bg-purple-200 py-2 px-6 rounded-md text-black font-semibold">
                {{ $user->nama }} <!-- Menggunakan variabel $user -->
            </div>
            <div class="bg-purple-200 py-2 px-6 rounded-md text-black font-semibold">
                {{ $user->npm }} <!-- Menggunakan variabel $user -->
            </div>
            <div class="bg-purple-200 py-2 px-6 rounded-md text-black font-semibold">
                {{ $user->nama_kelas ?? 'Kelas tidak ditemukan' }} <!-- Nilai default jika nama_kelas null -->
            </div>
        </div>
    </div>

</body>
</html>
