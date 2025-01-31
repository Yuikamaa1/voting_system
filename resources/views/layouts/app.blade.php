<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Library Management System') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"> <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> <!-- Custom Stylesheet -->
    <style>
        #sidebar {
            background-color: #343a40; /* Dark sidebar */
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        #sidebar .menu {
            padding: 0;
            margin: 0;
        }

        #sidebar .menu a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
            border-bottom: 1px solid #495057;
            transition: background 0.3s;
        }

        #sidebar .menu a:hover,
        #sidebar .menu a.active {
            background-color: #ffc340; /* Highlight color for active link */
            color: #000;
        }

        #sidebar .menu .dropdown .dropdown-toggle {
            padding: 10px 20px;
            display: block;
            color: #fff;
            background-color: transparent;
            text-decoration: none;
            transition: background 0.3s;
        }

        #sidebar .menu .dropdown .dropdown-menu {
            background-color: #343a40; /* Match sidebar background */
            border: none;
            box-shadow: none;
            padding: 0;
        }

        #sidebar .menu .dropdown-menu a {
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-bottom: 1px solid #495057;
            transition: background 0.3s;
        }

        #sidebar .menu .dropdown-menu a:hover {
            background-color: #ffc340; /* Highlight color */
            color: #000;
        }

        #sidebar .auth {
            margin-top: auto; /* Push the logout button to the bottom */
        }

        #main-content {
            padding: 20px;
            background-color: #ffc340;
            min-height: 100vh;
        }
    </style>
</head>

<body>
    <!-- SIDEBAR -->
    <div id="sidebar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-4 mt-4">
                    <ul class="menu list-unstyled d-flex flex-column">
                        <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a></li>
                        <li><a href="{{ route('students.index') }}" class="{{ request()->routeIs('students.index') ? 'active' : '' }}">Students</a></li>
                        <li><a href="{{ route('teachers.index') }}" class="{{ request()->routeIs('teachers.index') ? 'active' : '' }}">Teachers</a></li>
                        <li><a href="{{ route('books.index') }}" class="{{ request()->routeIs('books.index') ? 'active' : '' }}">Books</a></li>
                        <li><a href="{{ route('reports.index') }}" class="{{ request()->routeIs('reports.index') ? 'active' : '' }}">Available Books</a></li>
                        <li><a href="{{ route('book_issue.index') }}" class="{{ request()->routeIs('book_issue.index') ? 'active' : '' }}">Issued Books</a></li>
                        <li><a href="{{ route('settings') }}" class="{{ request()->routeIs('settings') ? 'active' : '' }}">Settings</a></li>
                    </ul>

                    <div class="auth">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Hi, {{ auth()->user()->name }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('change_password') }}">Change Password</a>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">Log Out</a>
                            </div>
                            <form method="POST" id="logoutForm" action="{{ route('logout') }}" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-8">
                    <!-- Main Content -->
                    <div id="main-content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /SIDEBAR -->

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
