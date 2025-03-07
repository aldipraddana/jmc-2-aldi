<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $menu.' - Pengelolaan Barang Masuk' }}</title>
    <!-- Scripts -->
    <link href="{{ asset('library/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css?time='.time()) }}">
    <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet" />
    @yield('styles')
</head>

<body>
    {{-- sidebars --}}
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-menu-hamburger-1"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="/">Pengelolaan Barang</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="{{ route('incoming.items') }}" class="sidebar-link {{ $menu == 'Barang Masuk' ? 'active' : '' }}">
                        <i class="lni lni-chevron-down-circle"></i>
                        <span>Barang Masuk</span>
                    </a>
                </li>
                @if (Auth::user()->role == 'admin')
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link {{ $menu == 'Kategori' || $menu == 'Sub Kategori'  ? '' : 'collapsed' }} has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#master-data" aria-expanded="false" aria-controls="master-data">
                        <i class="lni lni-dropbox"></i>
                        <span>Master Data</span>
                    </a>
                    <ul id="master-data" class="sidebar-dropdown collapse {{ $menu == 'Kategori' || $menu == 'Sub Kategori'  ? 'show' : '' }}" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="{{ route('category') }}" class="sidebar-link {{ $menu == 'Kategori' ? 'active' : '' }}">
                                <span>Kategori</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('sub-category') }}" class="sidebar-link {{ $menu == 'Sub Kategori' ? 'active' : '' }}">
                                <span>Sub Kategori</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('user-management') }}" class="sidebar-link {{ $menu == 'User Manajemen' ? 'active' : '' }}">
                        <i class="lni lni-user-multiple-4"></i>
                        <span>Manajemen User</span>
                    </a>
                </li>
                @endif
            </ul>
            <div class="sidebar-footer">
                <form action="{{ route('logout') }}" method="POST" class="js--logout d-none">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
                <a href="#" class="sidebar-link js--trigger-logout">
                    <i class="lni lni-exit"></i>
                    <span>Logout ({{ Auth::user()->username }})</span>
                </a>
            </div>
        </aside>
        {{-- end sidebars --}}

        {{-- main content --}}
        <div class="main p-3">
            @yield('section')
        </div>
    </div>

</body>

<script src="{{ asset('library/bootstrap.min.js') }}"></script>
<script src="{{ asset('library/jquery.min.js') }}"></script>
<script src="{{ asset('library/moment.min.js') }}"></script>
<script src="{{ asset('library/sidebars.js?time='.time()) }}"></script>
@yield('scripts')

</html>
