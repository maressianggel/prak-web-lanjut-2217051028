<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('Daftar Pengguna')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #FFC0CB, #FFFFFF, #E0B0FF);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Open Sans', Times New Roman;
        }
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #f9d7da;
            color: #333; 
            border-bottom: none;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        .btn-primary {
            background-color: #f9d7da; 
            border: none;
            color: #333;
            width: 150px; 
            margin: 0 auto; 
            display: block; 
        }
        .btn-primary:hover {
            background-color: #f8bcbc; 
        }
        .form-group {
            margin-bottom: 10px;
        }
        label {
            margin-bottom: 5px;
        }
        .form-control {
            padding: 8px;
        }
        .text-red-500 {
            color: #e3342f;
            margin-top: 2px;
            font-size: 0.875rem;
        }
        .form-group p {
            margin-bottom: 0;
        }
    </style>
    @yield('additional-styles')
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @yield('additional-scripts')
</body>
</html>
