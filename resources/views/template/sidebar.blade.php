 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="/home">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      @if (Auth::user()->hasPermissionTo('list_patient'))
      <li class="nav-item">
        <a class="nav-link collapsed" href="/patient">
          <i class="ri-user-heart-fill"></i>
          <span>Patients</span>
        </a>
      </li><!-- End Profile Page Nav -->
      @endif

      @if (Auth::user()->hasPermissionTo('list_request'))
      <li class="nav-item">
        <a class="nav-link collapsed" href="/request">
          <i class="bx bxs-message-alt-add"></i>
          <span>Requests</span>
        </a>
      </li>
      @endif

      @if (Auth::user()->hasPermissionTo('list_bloodbag'))
        
      <li class="nav-item">
        <a class="nav-link collapsed" href="/store">
          <i class="bi bi-droplet-fill"></i>
          <span>Blood Bags</span>
        </a>
      </li><!-- End Contact Page Nav -->
      @endif

      @if (Auth::user()->hasPermissionTo('list_donator'))
      <li class="nav-item">
        <a class="nav-link collapsed" href="/donators">
          <i class="bx bxs-donate-heart"></i>
          <span>Donators</span>
        </a>
      </li><!-- End Register Page Nav -->
      @endif

      @if (Auth::user()->hasPermissionTo('list_donation'))
      <li class="nav-item">
        <a class="nav-link collapsed" href="/donations">
          <i class="ri-heart-add-fill"></i>
          <span>Donations</span>
        </a>
      </li><!-- End Login Page Nav -->
      @endif

      @if (Auth::user()->hasPermissionTo('list_donationRequest'))
        
      <li class="nav-item">
        <a class="nav-link collapsed" href="/b-request">
          <i class="bi bi-shield-fill-plus"></i>
          <span>Donations Requests</span>
        </a>
      </li><!-- End Error 404 Page Nav -->
      @endif

      @if (Auth::user()->hasPermissionTo('list_campaign'))
      <li class="nav-item">
        <a class="nav-link collapsed" href="/campaigns">
          <i class="bi bi-megaphone-fill"></i>
          <span>Campaigns</span>
        </a>
      </li><!-- End Blank Page Nav -->
      @endif

      @if (Auth::user()->hasPermissionTo('list_report'))
        
      <li class="nav-item">
        <a class="nav-link collapsed" href="/report">
          <i class="bx bxs-file"></i>
          <span>Report</span>
        </a>
      </li><!-- End Blank Page Nav -->
      @endif
      
      @if (Auth::user()->hasPermissionTo('list_user'))
        
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#user-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people-fill"></i><span>User</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="user-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/user">
              <i class="bi bi-circle"></i><span>Users</span>
            </a>
          </li>
          <li>
            <a href="/usergroup">
              <i class="bi bi-circle"></i><span>User Group</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->
      @endif
    </ul>

  </aside><!-- End Sidebar-->