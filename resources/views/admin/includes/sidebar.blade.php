<div class="sidebar sidebar-navigation active">
    <div class="logo_content">
        <a href="{{ route('dashboard') }}" class="logo">
            {{-- <img class="logo-icon" src="{{ asset('admin/images/logo.png') }}"> --}}
            <span class="logo-icon"><i class="ri-file-2-line" style="font-size: 22px; color: #047857;"></i></span>

            <div class="logo_name">
                {{-- <img style="max-height: 45px; width: 130px; object-fit: contain;"
                    src="{{ asset('admin/images/logo.png') }}" alt=""> --}}
                    <span style="font-size: 20px; font-weight: 600; color: #047857;">
                        FileManager
                    </span>
            </div>
        </a>
    </div>
    <ul class="nav_list ps-0 scrollbar">
        <li class="category-li">
            <span class="link_names">Dashboard</span>
        </li>
        <li>
            @if(Auth::user()->hasRole('admin'))
                <a href="{{ route('dashboard') }}" class="{{ Route::is('admin.dashboard') ? ' active-focus' : '' }}">
            @elseif (Auth::user()->hasRole('user'))
                <a href="{{ route('dashboard') }}" class="{{ Route::is('dashboard') ? ' active-focus' : '' }}">
            @endif
                <i class="ri-home-4-line"></i>
                <span class="link_names">Dashboard</span>
            </a>
        </li>


        <li class="category-li">
            <span class="link_names">Main</span>
        </li>

        @canany(['term-list', 'term-create', 'term-edit'])
        <li>
            <a href="{{ route('admin.terms.index') }}" class="{{ in_array(Route::currentRouteName(), [ 'admin.terms.index', 'admin.terms.create', 'admin.terms.edit']) ? 'active-focus' : '' }}">
                <i class="ri-calendar-event-line"></i>
                <span class="link_names">Manage Terms</span>
            </a>
        </li>
        @endcanany

        @canany(['batch-list', 'batch-create', 'batch-edit'])
        <li>
            <a href="{{ route('admin.batches.index') }}"
            class="{{ in_array(Route::currentRouteName(), ['admin.batches.index','admin.batches.create','admin.batches.edit']) ? 'active-focus' : '' }}">
                <i class="ri-group-line"></i>
                <span class="link_names">Manage Batches</span>
            </a>
        </li>
        @endcanany

        
        @canany(['teacher-list', 'teacher-create', 'teacher-edit'])
        <li>
            <a href="{{ route('admin.teachers.index') }}"
            class="{{ in_array(Route::currentRouteName(), ['admin.teachers.index','admin.teachers.create','admin.teachers.edit']) ? 'active-focus' : '' }}">
                <i class="ri-team-line"></i>
                <span class="link_names">Manage Teachers</span>
            </a>
        </li>
        @endcanany

        @canany(['course-type-list', 'course-type-create', 'course-type-edit'])
        <li>
            <a href="{{ route('admin.course-types.index') }}"
            class="{{ in_array(Route::currentRouteName(), ['admin.course-types.index','admin.course-types.create','admin.course-types.edit']) ? 'active-focus' : '' }}">
                <i class="ri-book-mark-line"></i>
                <span class="link_names">Course Types</span>
            </a>
        </li>
        @endcanany


        @canany(['course-list', 'course-create', 'course-edit'])
        <li>
            <a href="{{ route('admin.courses.index') }}"
            class="{{ in_array(Route::currentRouteName(), ['admin.courses.index','admin.courses.create','admin.courses.edit']) ? 'active-focus' : '' }}">
                <i class="ri-book-open-line"></i>
                <span class="link_names">Manage Courses</span>
            </a>
        </li>
        @endcanany


        @canany(['category-list', 'category-create', 'category-edit'])
        <li>
            <a href="{{ route('admin.categories.index') }}"
            class="{{ in_array(Route::currentRouteName(), ['admin.categories.index','admin.categories.create','admin.categories.edit']) ? 'active-focus' : '' }}">
                <i class="ri-folder-2-line"></i>
                <span class="link_names">Categories</span>
            </a>
        </li>
        @endcanany

        @canany(['file-list', 'file-upload'])
        <li>
            <a href="{{ route('admin.files.index') }}"
            class="{{ in_array(Route::currentRouteName(), ['admin.files.index']) ? 'active-focus' : '' }}">
                <i class="ri-file-2-line"></i>
                <span class="link_names">Upload Your Files</span>
            </a>
        </li>
        @endcanany



        @canany(['file-monitor'])
        <li>
            <a href="{{ route('admin.files.monitor') }}"
            class="{{ in_array(Route::currentRouteName(), ['admin.files.monitor']) ? 'active-focus' : '' }}">
                <i class="ri-file-2-line"></i>
                <span class="link_names">Files Monitor</span>
            </a>
        </li>
        @endcanany
            
        @if(Auth::user()->hasRole('admin'))
            @canany(['user-list', 'user-create', 'user-edit', 'user-delete', 'role-list', 'role-create', 'role-edit', 'role-delete'])
                <li class="category-li">
                    <span class="link_names">Users</span>
                </li>
            @endcan
            @canany(['user-list', 'user-create', 'user-edit', 'user-delete'])
                <li class="drop-item">
                    <a href="{{ route('admin.users.index') }}"
                        class="{{ in_array(Route::currentRouteName(), ['admin.users.index', 'admin.users.create', 'admin.users.edit']) ? 'active-focus' : '' }}">
                        <i class="ri-user-3-line"></i>
                        <span class="link_names">User List</span>
                    </a>
                </li>
            @endcan
            @canany(['role-list', 'role-create', 'role-edit', 'role-delete'])
                <li class="drop-item">
                    <a href="{{ route('admin.roles.index') }}"
                        class="{{ in_array(Route::currentRouteName(), ['admin.roles.index', 'admin.roles.create', 'admin.roles.edit']) ? 'active-focus' : '' }}">
                        <i class="ri-shield-user-line"></i>
                        <span class="link_names">Role</span>
                    </a>
                </li>
                <li class="drop-item">
                    <a href="{{ route('admin.assign-roles.index') }}"
                        class="{{ in_array(Route::currentRouteName(), ['admin.assign-roles.index']) ? 'active-focus' : '' }}">
                        <i class="ri-user-settings-line"></i>
                        <span class="link_names">Assign Role</span>
                    </a>
                    <span class="tooltip">Assign Role</span>
                </li>
            @endcan
        @endif

    </ul>

    <div class="profile_content">
        <div class="profile">
            <div class="profile_details">
                @if (Auth::user()->image)
                    <img id="sidebarImageDB" src="{{ asset('storage/' . Auth::user()->image) }}" alt="img" width="30"
                        height="30" class="rounded-circle">
                @else
                    <i class="ri-user-3-line profile-icon"></i>
                @endif

                <div class="name_job">
                    <div class="name">{{ Auth::user()->name }}</div>
                    <div class="job">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="d-flex"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="ri-logout-box-r-line" id="log_out"></i>
                </a>
            </form>
        </div>
    </div>
</div>
