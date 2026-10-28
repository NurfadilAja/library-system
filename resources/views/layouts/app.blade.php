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
            <a href="{{ route('dashboard') }}">Dashboard</a> |
            <a href="{{ route('books.index') }}">Books</a> |
            <a href="{{ route('categories.index') }}">Categories</a> |
            <a href="{{ route('members.index') }}">Members</a>

            @auth
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
        <p>Library System</p>
    </footer>
</body>
</html>
