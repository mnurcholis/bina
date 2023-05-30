<!-- ========== Left Sidebar Start ========== -->
<style>
    span {
        color: white;
    }

    #sidebar-menu {
        background: #000080;
    }

    .simplebar-content-wrapper {
        background: #000080 !important;
    }
</style>
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu" style="background:#000080">
                @if (auth()->user()->can('dashboard') ||
                        auth()->user()->can('master-data') ||
                        auth()->user()->can('history-log-list'))
                    <li class="menu-title" key="t-menu">Menu</li>
                @endif

                @if (auth()->user()->can('dashboard'))
                    <li>
                        <a href="{{ url('') }}" class="waves-effect">
                            <i class="bx bx-home-circle"></i>
<<<<<<< HEAD
                            <span key="t-dashboards">Dashboard</span>
=======
                            <span key="t-dashboards">Ke Halaman Depan</span>
>>>>>>> 62aaa4a (update dari sana)
                        </a>
                    </li>
                @endif

                @if (auth()->user()->can('master-data'))
                    <li>
                        <a href="{{ route('dashboard.index') }}" class="waves-effect">
                            <i class="bx bx-home-circle"></i>
                            <span key="t-dashboards">Dashboard</span>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->can('master-data'))
                    <li>
                        <a href="{{ route('daftar_pembayaran') }}">
                            <i class="mdi mdi-folder-outline"></i>
<<<<<<< HEAD
                            <span key="t-dashboards">Kategori</span>
=======
                            <span data-key="t-dashboard">Transaksi</span>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->can('master-data'))
                    <li>
                        <a href="{{ route('transaksi-list') }}">
                            <i class="mdi mdi-folder-outline"></i>
                            <span data-key="t-dashboard">Status Pemesanan</span>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->can('master-data'))
                    <li>
                        <a href="{{ route('data-penjualan') }}">
                            <i class="mdi mdi-folder-outline"></i>
                            <span data-key="t-dashboard">Data Penjualan</span>
>>>>>>> 62aaa4a (update dari sana)
                        </a>
                    </li>
                @endif

                @if (auth()->user()->can('master-data'))
                    <li>
                        <a href="{{ route('buku-list') }}">
                            <i class="mdi mdi-folder-outline"></i>
                            <span data-key="t-dashboard">Data Buku</span>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->can('master-data'))
                    <li>
<<<<<<< HEAD
                        <a href="{{ route('data-buku-list') }}">
                            <i class="mdi mdi-folder-outline"></i>
                            <span data-key="t-dashboard">Daftar List Buku</span>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->can('master-data'))
                    <li>
=======
>>>>>>> 62aaa4a (update dari sana)
                        <a href="{{ route('data-buku-masuk') }}">
                            <i class="mdi mdi-folder-outline"></i>
                            <span data-key="t-dashboard">Data Buku Masuk</span>
                        </a>
                    </li>
                @endif

<<<<<<< HEAD
                @if (auth()->user()->can('master-data'))
                    <li>
                        <a href="{{ route('transaksi-list') }}">
                            <i class="mdi mdi-folder-outline"></i>
                            <span data-key="t-dashboard">Data Pemesanan</span>
                        </a>
                    </li>
                @endif
=======
>>>>>>> 62aaa4a (update dari sana)

                @if (auth()->user()->can('master-data'))
                    <li>
                        <a href="{{ route('kategori-list') }}" class="waves-effect">
                            <i class="mdi mdi-folder-outline"></i>
<<<<<<< HEAD
                            <span data-key="t-dashboard">Data Pembayaran</span>
=======
                            <span key="t-dashboards">Kategori</span>
>>>>>>> 62aaa4a (update dari sana)
                        </a>
                    </li>
                @endif

                @if (auth()->user()->can('master-data'))
                    <li>
                        <a href="{{ route('users.index') }}">
                            <i class="mdi mdi-folder-outline"></i>
                            <span data-key="t-dashboard">Data Pengguna</span>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->can('master-data'))
                    <li>
                        <a href="{{ route('data-buku-list') }}">
                            <i class="mdi mdi-folder-outline"></i>
                            <span data-key="t-dashboard">Daftar List Buku</span>
                        </a>
                    </li>
                @endif


                <li>
                    <form action="{{ url('/logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn">
                            <i class="mdi mdi-logout"></i>
                            <span data-key="t-dashboard">Keluar</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
