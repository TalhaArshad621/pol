 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="/home">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#hospital-nav" data-bs-toggle="collapse">
          <i class="bi bi-menu-button-wide"></i><span>Hospital</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="hospital-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/patient">
              <i class="bi bi-circle"></i><span>Patient</span>
            </a>
          </li>
          <li>
            <a href="/request">
              <i class="bi bi-circle"></i><span>Requests</span>
            </a>
          </li>
          <li>
            <a href="/hospital_report">
              <i class="bi bi-circle"></i><span>Hospital Report</span>
            </a>
          </li>
        </ul>
      </li>
      
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#bloodBank-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Blood bank</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="bloodBank-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/store">
              <i class="bi bi-circle"></i><span>store</span>
            </a>
          </li>
          <li>
            <a href="/donator">
              <i class="bi bi-circle"></i><span>donator</span>
            </a>
          </li>
          <li>
            <a href="/request">
              <i class="bi bi-circle"></i><span>Requests</span>
            </a>
          </li>
          <li>
            <a href="/campaign">
              <i class="bi bi-circle"></i><span>campaigns</span>
            </a>
          </li>
          <li>
            <a href="/report">
              <i class="bi bi-circle"></i><span>Report</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#user-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>User</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="user-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/user">
              <i class="bi bi-circle"></i><span>users</span>
            </a>
          </li>
          <li>
            <a href="/usergroup">
              <i class="bi bi-circle"></i><span>user group</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->
    </ul>

  </aside><!-- End Sidebar-->