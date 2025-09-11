<ul class="main-menu__list">
    <li class="dropdown">
        <a href="{{ route('home') }}">Home</a>
        <ul>
            <li><a href="{{ route('home') }}">Home One</a></li>
            <li class="dropdown">
                <a href="#">Header Styles</a>
                <ul>
                    <li><a href="{{ route('home') }}">Header One</a></li>
                  
                </ul>
            </li>
        </ul>
    </li>
    <li>
        <a href="#">About</a>
    </li>
    <li>
        <a href="{{ route('login') }}">Login</a>
    </li>
    <li>
        <a href="{{ route('register') }}">Register</a>
    </li>
    