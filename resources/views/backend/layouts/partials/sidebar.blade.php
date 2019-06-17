<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">

        <ul class="nav flex-column">
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ admin_route('login') }}">{{ __('Login') }}</a>
                </li>
            @else
                <li class="nav-item dropdown bg-secondary">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>

                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="#">{{__('Thông tin')}}</a>
                        <a class="dropdown-item" href="{{ admin_route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }} </a>
                    </div>

                    <form id="logout-form" action="{{ admin_route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endguest
        </ul>


        <ul class="nav flex-column">
            <li class="nav-item ">
                <a class="nav-link {{ request()->is('admin') ? 'active' : '' }}" href="#">
                    <span data-feather="home"></span>
                    Dashboard <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('admin/categories') || request()->is('admin/categories/*')) ? 'active' : '' }}" href="{{ admin_route('categories.index') }}">
                    <span data-feather="file"></span>
                    Danh Mục
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ admin_route('logs.index') }}">
                    <span data-feather="file"></span>
                    Logs
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Saved reports</span>
            <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Current month
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Last quarter
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Social engagement
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Year-end sale
                </a>
            </li>
        </ul>
    </div>
</nav>