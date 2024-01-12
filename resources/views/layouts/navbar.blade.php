@if (Auth::check())
<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Task</a>
                </li>
            </ul>
        </div>
        <div class="left-side d-grid gap-2 d-md-flex justify-content-md-end">
            <div class="img-container">
                <img class="profile-img" src="" alt="">
            </div>
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  {{ Auth::user()->username }}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <form class="logout" action="/logout" method="POST">
                        @csrf
                        <button class="btn btn-text text-danger btn-logout">Logout</button>
                    </form>
                </ul>
            </div>
        </div>
    </div>
</nav>
@endif