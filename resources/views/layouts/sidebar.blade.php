<aside id="sidebar" class="bg-light" style="min-width: 15rem;">
    <ul class="nav flex-column">
        <li class="nav-item @if(request()->segment(1) == 'dashboard') active @endif">
            <a href="{{ route('dashboard') }}" class="nav-link">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @if (auth()->user()->id == '1')
            <li class="nav-item @if(request()->segment(1) == 'student') active @endif">
                <a href="{{ route('student.index') }}" class="nav-link">
                    <i class="bi bi-mortarboard"></i>
                    <span>Students</span>
                </a>
            </li>
            <li class="nav-item @if(request()->segment(1) == 'major') active @endif">
                <a href="{{ route('major.index') }}" class="nav-link">
                    <i class="bi bi-book"></i>
                    <span>Majors</span>
                </a>
            </li>
        @endif

        <li class="nav-item @if(request()->segment(1) == 'enrollment') active @endif">
            <a href="{{ route('enrollment.index') }}" class="nav-link">
                <i class="bi bi-journal-check"></i>
                <span>Enrollments</span>
            </a>
        </li>

        @if (auth()->user()->id == '1')
            <li class="nav-item @if(request()->segment(1) == 'user') active @endif">
                <a href="{{ route('user.index') }}" class="nav-link">
                    <i class="bi bi-people"></i>
                    <span>Users</span>
                </a>
            </li>

            <li class="nav-item @if(request()->segment(1) == 'role') active @endif">
                <a href="{{ route('role.index') }}" class="nav-link">
                    <i class="bi bi-shield-lock"></i>
                    <span>Roles</span>
                </a>
            </li>
        @endif

    </ul>

</aside>
