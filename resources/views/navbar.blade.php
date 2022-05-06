<nav class="navbar navbar-expand-lg navbar-light bg-light mb-2">
    <a class="navbar-brand" href="/">Navbar</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Person Management</a>
            </li>
            <li class="nav-item">
                <form method="post" action="{{route('logout')}}" class="form-inline my-2 my-lg-0">
                    @csrf
                    <button class="nav-link" href="/">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
