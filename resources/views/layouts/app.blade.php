<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
</head>
<body>
    <header>
        <h1>Library System</h1>
        <nav>
            <a href="/dashboard">Dashboard</a> |
            <a href="/books">Books</a> |
            <a href="/categories">Categories</a> |
            <a href="/members">Members</a>

            @auth
                |
                <form action="{{ route('logout') }}" method="POST"
                      style="display: inline;">
                    @csrf
                    <button type="submit" style="
                        background-color: #dc3545;
                        color: white;
                        border: none;
                        padding: 6px 12px;
                        border-radius: 5px;
                        cursor: pointer;
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
        <p>Library System</p>
    </footer>
</body>
</html>