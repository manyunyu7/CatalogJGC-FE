<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo d-flex">
                    <h1 class="mr-3 d-none">Bestari Setia Abadi</h1>
                    <a href="{{ url('/admin') }}"><img src="{{ asset('/bsb') }}/logo-green.png" alt="Logo"
                            srcset="" class="img-fluid" style="height: 70px !important;"></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li
                    class="sidebar-item
                {{ Request::is('admin') ? 'active' : '' }}
                {{ Request::is('staff') ? 'active' : '' }}
                {{ Request::is('user') ? 'active' : '' }}
                ">
                    <a href="{{ url('/home') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item  has-sub {{ Request::is('admin/user/*') ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-person"></i>
                        <span>Manajemen User</span>
                    </a>
                    <ul class="submenu  {{ Request::is('admin/user/*') ? 'active' : '' }} ">
                        <li class="submenu-item  {{ Request::is('/admin/user/create') ? 'active' : '' }}">
                            <a href="{{ url('/admin/user/create') }}">Tambah User</a>
                        </li>
                        <li class="submenu-item  {{ Request::is('/admin/user/manage') ? 'active' : '' }}">
                            <a href="{{ url('/admin/user/manage') }}">Manage</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub  {{ Request::is('company-profile/*') ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-building"></i>
                        <span>Company Profile</span>
                    </a>
                    <ul class="submenu  {{ Request::is('company-profile/*') ? 'active' : '' }} ">
                        {{-- <li class="submenu-item   {{ Request::is('company-profile/basic-info') ? 'active' : '' }}">
                            <a href="{{ url('company-profile/basic-info') }}">Informasi</a>
                        </li> --}}
                        <li class="submenu-item   {{ Request::is('company-profile/slider') ? 'active' : '' }}">
                            <a href="{{ url('company-profile/slider') }}">Slider</a>
                        </li>
                        {{-- <li class="submenu-item {{ Request::is('company-profile/client') ? 'active' : '' }}">
                            <a href="{{ url('company-profile/client') }}">List Klien</a>
                        </li>
                        <li class="submenu-item {{ Request::is('company-profile/brand') ? 'active' : '' }}">
                            <a href="{{ url('company-profile/brand') }}">List Merk</a>
                        </li>
                        <li class="submenu-item {{ Request::is('company-profile/gallery/manage') ? 'active' : '' }}">
                            <a href="{{ url('company-profile/gallery/manage') }}">Manage Gallery</a>
                        </li>
                        <li class="submenu-item {{ Request::is('company-profile/whatsapp/manage') ? 'active' : '' }}">
                            <a href="{{ url('company-profile/whatsapp/manage') }}">Manage Whatsapp</a>
                        </li> --}}
                    </ul>
                </li>

                <li class="sidebar-item {{ Request::is('cms/manage-product') ? 'active' : '' }}">
                    <a href="{{ url('cms/manage-product') }}" class="sidebar-link">
                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                        <span>Products</span>
                    </a>
                </li>

                <li class="sidebar-item has-sub {{ Request::is('cms/fasilitas*') ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-tools"></i>
                        <span>Fasilitas</span>
                    </a>
                    <ul class="submenu {{ Request::is('cms/fasilitas*') ? 'active' : '' }}">
                        <li class="submenu-item {{ Request::is('cms/fasilitas') ? 'active' : '' }}">
                            <a href="{{ url('cms/fasilitas') }}">List Fasilitas</a>
                        </li>
                        <li class="submenu-item {{ Request::is('cms/fasilitas/create') ? 'active' : '' }}">
                            <a href="{{ url('cms/fasilitas/create') }}">Tambah Fasilitas</a>
                        </li>
                    </ul>
                </li>


                <li class="sidebar-title">Inbox</li>
                <li class="sidebar-title">Logout</li>
                <li class="sidebar-item  ">

                    <a href="{{ url('/logout') }}" class="sidebar-link">
                        <i class="bi bi-life-preserver"></i>
                        <span>Logout</span>
                    </a>
                </li>




            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
