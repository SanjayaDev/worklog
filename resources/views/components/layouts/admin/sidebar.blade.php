<div id="sidebar" class="active">
  <div class="sidebar-wrapper active">
      <div class="sidebar-header">
          <div class="d-flex justify-content-between">
              <div class="logo">
                {{-- <p>Selamat Datang</p> --}}
              </div>
              <div class="toggler">
                  <a href="#" class="sidebar-hide d-xl-none d-block"><i class="fas fa-close"></i></a>
              </div>
          </div>
      </div>
      <div class="sidebar-menu">
          <ul class="menu">
              <li class="sidebar-title">Menu</li>

              <li class="sidebar-item {{ $title == "Dashboard" ? 'active' : '' }}">
                  <a href="/dashboard" class='sidebar-link'>
                      <i class="fas fa-dashboard"></i>
                      <span>Dashboard</span>
                  </a>
              </li>

              @can('check-module', '002U')
                <li class="sidebar-item {{ $title == "Users Management" ? 'active' : '' }}">
                  <a href="/dashboard/users" class='sidebar-link'>
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                  </a>
                </li> 
              @endcan

              @can('check-module', '003PJ')
                <li class="sidebar-item {{ $title == "Projects Management" ? 'active' : '' }}">
                  <a href="/dashboard/projects" class='sidebar-link'>
                    <i class="fas fa-walkie-talkie"></i>
                    <span>Projects</span>
                  </a>
                </li> 
              @endcan

              <li class="sidebar-item">
                <form action="/logout" method="POST">
                  @csrf
                  <button class='btn-hide border-none w-100 sidebar-link'>
                    <i class="fas fa-sign-out"></i>
                    <span>Logout</span>
                  </button>
                </form>
              </li>

              {{-- <li class="sidebar-item  has-sub">
                  <a href="#" class='sidebar-link'>
                      <i class="fas fa-user"></i>
                      <span>Components</span>
                  </a>
                  <ul class="submenu ">
                      <li class="submenu-item ">
                          <a href="component-alert.html">Alert</a>
                      </li>
                  </ul>
              </li>

              <li class="sidebar-title">Forms &amp; Tables</li>
              <li class="sidebar-item  ">
                  <a href="form-layout.html" class='sidebar-link'>
                      <i class="fas fa-folder-minus"></i>
                      <span>Form Layout</span>
                  </a>
              </li> --}}

          </ul>
      </div>
      <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
  </div>
</div>