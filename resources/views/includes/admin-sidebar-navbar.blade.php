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
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
      Report's Management
    </div>

      <li class="nav-item">
        <a class="nav-link" href="#modal-id-create" data-toggle="modal">
          <strong>
            <i class="fas fa-fw fa-plus"></i>
            <span>Create</span>
          </strong>
        </a>
      </li>
      <hr class="sidebar-divider my-0">
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReports" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Reports</span>
      </a>
      <div id="collapseReports" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="{{ route('research.index') }}">Research</a>
          <a class="collapse-item" href="{{ route('extension.index') }}">Extension</a>
        </div>
      </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Heading -->
    <div class="sidebar-heading">
      Posts Management
    </div>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePosts" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Posts</span>
      </a>
      <div id="collapsePosts" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="{{ url('/manage/news') }}">News</a>
          <a class="collapse-item" href="{{ url('/manage/announcements') }}">Announcements</a>
          <a class="collapse-item" href="{{ url('/manage/events') }}">Events</a>
        </div>
      </div>
    </li>
   <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
      Users Management
    </div>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUserManagement" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-users"></i>
        <span>Users</span>
      </a>
      <div id="collapseUserManagement" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
         <a class="collapse-item" href="{{ url('/manage/users') }}">Users</a>
        </div>
      </div>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
  </ul>
<div class="modal fade" id="modal-id-create">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fas fa-fw fa-plus"></i> Create</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <form action="{{ route('card.store') }}" method="POST" role="form">
          <div class="form-group">
            <label for="fiscalYear">Type</label>
            <select id="boardType" class="form-control" name="type" required>
              <option>research</option>
              <option>extension</option>
            </select>
          </div>
          <div class="form-group">
            @csrf
            <label for="fiscalYear">Fiscal-Year</label>
            <select id="fiscalYear" class="form-control" name="fiscal_year" required>
              @for($i=date('Y'); $i >= 2000; $i--)
              <option>FY {{ $i }}</option>
              @endfor
            </select>
          </div>
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" class="form-control" name="card_name" required>
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" class="form-control" name="description"></textarea>
          </div>
          <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" class="form-control" name="message"></textarea>
          </div>            

          <button type="submit" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
              <i class="fas fa-plus"></i>
            </span>
            <span class="text">Create</span>
          </button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
