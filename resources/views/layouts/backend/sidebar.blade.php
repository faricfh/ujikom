<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
      <img src="{{ asset('assets/backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('assets/frontend/img/chat/user.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ url('admin/user') }}" class="nav-link">
                    <i class="nav-icon fas fa-user" style="color:red"></i>
                    <p>User (Admin)</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/customer') }}" class="nav-link">
                    <i class="nav-icon fas fa-user" style="color:yellow"></i>
                    <p>Customer</p>
                    </a>
                </li>
                <li class="nav-item">
                <a href="{{ url('admin/kategori') }}" class="nav-link">
                    <i class="nav-icon fas fa-layer-group"></i>
                    <p>Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/produk') }}" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>Produk</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/stokmasuk') }}" class="nav-link">
                    <i class="nav-icon fas fa-cube" style="color:yellow"></i>
                    <p>Stok Masuk</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/stokkeluar') }}" class="nav-link">
                    <i class="nav-icon fas fa-cube" style="color:red"></i>
                    <p>Stok Keluar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/order') }}" class="nav-link">
                    <i class="nav-icon fas fa-plane"></i>
                    <p>Order</p>
                    </a>
                </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
