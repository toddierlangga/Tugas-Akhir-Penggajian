@section('sidebar')
<div class="sidebar" data-active-color="rose" data-background-color="black"
    data-image="{{ url('/assets/img/sidebar-1.jpg') }}">
    <!--
    Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
    Tip 2: you can also add an image using data-image tag
    Tip 3: you can change the color of the sidebar with data-background-color="white | black"
    -->
    <div class="logo">
        <a href="#" class="simple-text">
            Indotirta Suaka
        </a>
    </div>
    <div class="logo logo-mini">
        <a href="#" class="simple-text">
            ITS
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="{{ url('/assets/img/default-avatar.png') }}" />
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    {{ Auth::user()->nama }}
                    <b class="caret"></b>
                </a>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li>
                            <a href="{{ route('logout') }}">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            {{-- <li
                class="{{ (request()->is(Auth::user()->level.'/dashboard')) ? 'active' : '' }}">
                <a href="{{ url(Auth::user()->level.'/dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li> --}}

            {{-- SIDEBAR ADMIN --}}
            @if(Auth::user()->level == 'admin')
                <li
                    class="{{ (request()->is('admin/users*')) ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#users">
                        <i class="material-icons">face</i>
                        <p>Manajemen Pengguna
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ (request()->is('admin/users*')) ? 'in' : '' }}"
                        id="users">
                        <ul class="nav">
                            {{-- <li
                                class="{{ (request()->is('admin/users/add')) ? 'active' : '' }}">
                                <a href="{{ route('add_users') }}">Add Users</a>
                            </li> --}}
                            <li
                                class="{{ (request()->is('admin/users/list')) ? 'active' : '' }}">
                                <a href="{{ route('list_users') }}">Tambah Pengguna</a>
                            </li>
                            <li
                                class="{{ (request()->is('admin/users/list')) ? 'active' : '' }}">
                                <a href="{{ route('list_users') }}">Daftar Pengguna</a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- <li
                    class="{{ (request()->is('admin/suppliers/list')) ? 'active' : '' }}">
                    <a href="{{ route('list_supplier') }}">
                        <i class="material-icons">store</i>
                        <p>Suppliers</p>
                    </a>
                </li>
                <li
                    class="{{ (request()->is('admin/barang/list')) ? 'active' : '' }}">
                    <a href="{{ route('list_barang') }}">
                        <i class="material-icons">assignment</i>
                        <p>Barang</p>
                    </a>
                </li> --}}
                {{-- <li
                    class="{{ (request()->is('suppliers*')) ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#suppliers">
                        <i class="material-icons">store</i>
                        <p>Suppliers
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ (request()->is('admin/suppliers*')) ? 'in' : '' }}"
                        id="suppliers">
                        <ul class="nav">
                            <li
                                class="{{ (request()->is('admin/suppliers/add')) ? 'active' : '' }}">
                                <a href="{{ route('add_supplier') }}">Add Suppliers</a>
                            </li>
                            <li
                                class="{{ (request()->is('admin/suppliers/list')) ? 'active' : '' }}">
                                <a href="{{ route('list_supplier') }}">Suppliers List</a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
                {{-- <li
                    class="{{ (request()->is('barang*')) ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#barang">
                        <i class="material-icons">assignment</i>
                        <p>Barang
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ (request()->is('admin/barang*')) ? 'in' : '' }}"
                        id="barang">
                        <ul class="nav">
                            <li
                                class="{{ (request()->is('admin/barang/add')) ? 'active' : '' }}">
                                <a href="{{ route('add_barang') }}">Add Barang</a>
                            </li>
                            <li
                                class="{{ (request()->is('admin/barang/list')) ? 'active' : '' }}">
                                <a href="{{ route('list_barang') }}">Barang List</a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
            @endif

            {{-- SIDEBAR KEUANGAN --}}
            @if(Auth::user()->level == 'keuangan')
                <li
                    class="{{ (request()->is(Auth::user()->level.'/dashboard')) ? 'active' : '' }}">
                    <a href="{{ url(Auth::user()->level.'/dashboard') }}">
                        <i class="material-icons">loyalty</i>
                        <p>Data Gaji & Tunjangan</p>
                    </a>
                </li>
                <li
                    class="{{ (request()->is(Auth::user()->level.'/showgaji')) ? 'active' : '' }}">
                    <a href="{{ url(Auth::user()->level.'/showgaji') }}">
                        <i class="material-icons">portrait</i>
                        <p>Slip Gaji</p>
                    </a>
                </li>
            @endif

            {{-- SIDEBAR GENERAL MANAGER --}}
            @if(Auth::user()->level == 'gm')
            <li class="{{ (request()->is(Auth::user()->level.'/dashboard')) ? 'active' : '' }}">
                <a href="{{ url(Auth::user()->level.'/dashboard') }}">
                    <i class="material-icons">mark_email_unread</i>
                    <p>Validasi Slip Gaji</p>
                </a>
            </li>
            <li class="{{ (request()->is(Auth::user()->level.'/laporan')) ? 'active' : '' }}">
                <a href="{{ url(Auth::user()->level.'/laporan') }}">
                    <i class="material-icons">mark_email_unread</i>
                    <p>Laporan Gaji Karyawan</p>
                </a>
            </li>
            <li class="{{ (request()->is(Auth::user()->level.'/pajak')) ? 'active' : '' }}">
                <a href="{{ url(Auth::user()->level.'/pajak') }}">
                    <i class="material-icons">mark_email_unread</i>
                    <p>Laporan Pajak Karyawan</p>
                </a>
            </li>
            @endif

            {{-- SIDEBAR PERSONALIA/HRD --}}
            @if(Auth::user()->level == 'personalia')
            <li class="{{ (request()->is(Auth::user()->level.'/dashboard')) ? 'active' : '' }}">
                <a href="{{ url(Auth::user()->level.'/dashboard') }}">
                    <i class="material-icons">mark_email_read</i>
                    <p>Divisi</p>
                </a>
            </li>
            <li class="{{ (request()->is(Auth::user()->level.'/jabatan')) ? 'active' : '' }}">
                <a href="{{ url(Auth::user()->level.'/jabatan') }}">
                    <i class="material-icons">redeem</i>
                    <p>Jabatan</p>
                </a>
            </li>
            <li
                    class="{{ (request()->is(Auth::user()->level.'/karyawan')) ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#karyawan">
                        <i class="material-icons">face</i>
                        <p>Manajemen Karyawan
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ (request()->is(Auth::user()->level.'/karyawan')) ? 'in' : '' }}"
                        id="karyawan">
                        <ul class="nav">
                            <li
                                class="{{ (request()->is(request()->is(Auth::user()->level.'/karyawan/add'))) ? 'active' : '' }}">
                                <a href="{{ route('add_karyawan') }}">Tambah Karyawan</a>
                            </li>
                            <li
                                class="{{ (request()->is(request()->is(Auth::user()->level.'/karyawan'))) ? 'active' : '' }}">
                                <a href="{{ route('list_karyawan') }}">Daftar Karyawan</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</div>
@show
