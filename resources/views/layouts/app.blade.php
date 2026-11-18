<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Library System</title>
</head>
<body>
    <header>
        <h1>Library System</h1>
        <nav>
            <a href="{{ route('dashboard') }}">Dashboard</a> |
            <a href="{{ route('books.index') }}">Books</a> |
            <a href="{{ route('categories.index') }}">Categories</a> |
            <a href="{{ route('members.index') }}">Members</a> |
            <a href="{{ route('borrowings.index') }}">Peminjaman</a>

            @can('manage-users')
                | <a href="{{ route('users.index') }}">Kelola Pengguna</a>
            @endcan

            @auth
                |
                <span style="color: #555;">(Halo, {{ auth()->user()->name }} [<em>{{ auth()->user()->role }}</em>])</span>
                |
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" style="
                        background: none;
                        border: none;
                        color: red;
                        cursor: pointer;
                        text-decoration: underline;
                        font-size: inherit;
                        font-family: inherit;
                        padding: 0;
                    ">
                        Logout
                    </button>
                </form>
            @endauth
        </nav>
        <hr>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <hr>
        <p>Library System &copy; {{ date('Y') }}</p>
    </footer>
</body>
</html>
