<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('img/Logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('AdminLTE/dist/img/user2-160x160') }}.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }} </a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>
                @if (auth()->user()->level == 1)
                    <li class="nav-header">MASTER</li>
                    <li class="nav-item">
                        <a href="{{ route('kategori.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-cube"></i>
                            <p>
                                Kategori
                                {{-- <span class="right badge badge-danger">New</span> --}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('produk.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-cube"></i>
                            <p>
                                Produk
                                {{-- <span class="right badge badge-danger">New</span> --}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('member.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-id-card"></i>
                            <p>
                                Member
                                {{-- <span class="right badge badge-danger">New</span> --}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('supplier.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-truck"></i>
                            <p>
                                Supplier
                                {{-- <span class="right badge badge-danger">New</span> --}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Transaksi</li>
                    <li class="nav-item">
                        <a href="{{ route('pengeluaran.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-money-bill"></i>
                            <p>
                                Pengeluaran
                                {{-- <span class="right badge badge-danger">New</span> --}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pembelian.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-download"></i>
                            <p>
                                Pembelian
                                {{-- <span class="right badge badge-danger">New</span> --}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('penjualan.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-upload"></i>
                            <p>
                                Penjualan
                                {{-- <span class="right badge badge-danger">New</span> --}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('transaksi.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-cart-arrow-down"></i>
                            <p>
                                Transaksi Lama
                                {{-- <span class="right badge badge-danger">New</span> --}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('transaksi.baru') }}" class="nav-link">
                            <i class="nav-icon fas fa-cart-arrow-down"></i>
                            <p>
                                Transaksi Baru
                                {{-- <span class="right badge badge-danger">New</span> --}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Report</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-archive"></i>
                            <p>
                                Laporan
                                {{-- <span class="right badge badge-danger">New</span> --}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">System</li>
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-user-alt"></i>
                            <p>
                                Akun
                                {{-- <span class="right badge badge-danger">New</span> --}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                Pengaturan
                                {{-- <span class="right badge badge-danger">New</span> --}}
                            </p>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('penjualan.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-upload"></i>
                            <p>
                                Penjualan
                                {{-- <span class="right badge badge-danger">New</span> --}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('transaksi.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-cart-arrow-down"></i>
                            <p>
                                Transaksi Lama
                                {{-- <span class="right badge badge-danger">New</span> --}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('transaksi.baru') }}" class="nav-link">
                            <i class="nav-icon fas fa-cart-arrow-down"></i>
                            <p>
                                Transaksi Baru
                                {{-- <span class="right badge badge-danger">New</span> --}}
                            </p>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="$('#Logout').submit()">
                        <i class="nav-icon fa fa-sign-out-alt"></i>
                        <p>
                            Logout
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<form action="{{ route('logout') }}" method="post" id="Logout" style="display:none;">
    @csrf
</form>
