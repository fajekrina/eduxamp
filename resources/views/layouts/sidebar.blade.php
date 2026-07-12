<aside id="sidebar" class="bg-light" style="min-width: 15rem;">
    <ul class="nav flex-column pt-3">
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @if (Session::get('role_id') == '1')
          <li class="nav-item">
              <a href="#" class="nav-link">
                  <i class="bi bi-mortarboard"></i>
                  <span>Students</span>
              </a>
          </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-book"></i>
                    <span>Majors</span>
                </a>
            </li>
        @endif

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-journal-check"></i>
                <span>Enrollments</span>
            </a>
        </li>

        @if (Session::get('role_id') == '1')
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-people"></i>
                    <span>Users</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-shield-lock"></i>
                    <span>Roles</span>
                </a>
            </li>
        @endif

    </ul>

</aside>
