<ul class="sidebar navbar-nav">
  <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('admin/dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>
  @if (session("admin_status") == 2)
  <li class="nav-item {{ Request::is('employees') ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('employees') }}">
      <i class="fa fa-tasks"></i>
      <span>Employees</span>
    </a>
  </li>
  @endif
   <li class="nav-item {{ Request::is('users') ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('users') }}">
      <i class="fa fa-tasks"></i>
      <span>Users</span>
    </a>
  </li>
  <li class="nav-item {{ Request::is('categories') ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('categories') }}">
      <i class="fa fa-tasks"></i>
      <span>Categories</span>
    </a>
  </li>
  <li class="nav-item {{ Request::is('products') ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('products') }}">
      <i class="fas fa-book"></i>
      <span>Product</span>
    </a>
  </li>
  <li class="nav-item {{ Request::is('transactions') ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('transactions') }}">
      <i class="fas fa-shopping-cart"></i>
      <span>Transaction</span>
    </a>
  </li>
</ul>