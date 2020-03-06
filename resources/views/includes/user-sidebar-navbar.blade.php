<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">{{-- SB Admin <sup>2</sup> --}}</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('user.dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Manage Submissions
    </div>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReports" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-plus"></i>
        <span>Submit Report's For</span>
      </a>
      <div id="collapseReports" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="{{ route('user-research') }}">Research</a>
          <a class="collapse-item" href="{{ route('user-extension') }}">Extension</a>
        </div>
      </div>
    </li>
    {{-- <li class="nav-item">
      <a class="nav-link" href="{{ route('user-research') }}">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Research</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('user-extension') }}">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Extension</span></a>
    </li> --}}
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
  </ul>