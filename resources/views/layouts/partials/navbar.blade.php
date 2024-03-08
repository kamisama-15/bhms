<nav class="main-header navbar navbar-expand navbar-success">
    {{-- Left navbar links --}}
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-dark" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link"></a>
        </li>
    </ul>

    {{-- Right navbar links --}}
    <ul class="navbar-nav ml-auto">
    {{--  
        <li class="nav-item">
            <a class="nav-link" href="{{ action('MessageController@main') }}">
                <i class="fas fa-envelope"></i> Mail
                @if(countUnreadMessages(session('usrID')) > 0)
                    <span class="badge bg-warning">
                        {{ countUnreadMessages(session('usrID')) }}
                    </span>
                @endif
            </a>
        </li>

        @if(session('usrType') == '4')
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-bullhorn"></i> Bulletins 
                        @if(getAllCourseNotificationCount() > 0)
                            <span class="badge bg-warning">
                                {{ getAllCourseNotificationCount() }}
                            </span>
                        @endif
                    <i class="fas fa-caret-down"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">Course Bulletins</span>
                    <div class="dropdown-divider"></div>
                    @forelse(getAllCourseNotificationContent() as $coursestudent)
                        <a href="{{ action('BulletinController@main',[$coursestudent->crsID]) }}" class="dropdown-item">
                            <i class="fas fa-chalkboard-teacher mr-2"></i> {{ $coursestudent->crsCode }} 
                            <span class="badge bg-warning">{{ $coursestudent->clsAnnouncements }}</span>
                        </a>
                    @empty
                        <span class="text-muted"><small>  (No new course bulletin)</small></span>
                    @endforelse
                </div>
            </li>
       @endif --}}

        <li class="nav-item dropdown ">
            <a class="nav-link text-light btn btn-dark" data-toggle="dropdown" href="#"><i class="far fa-user-circle"></i>   {{ Auth::user()->first_name }} <i class="fas fa-caret-down"></i></a>
            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Account Management</span>
                <div class="dropdown-divider"></div>
                <a href="" class="dropdown-item">
                    <i class="fas fa-user-cog mr-2"></i> My Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-key mr-2"></i> Change Password
                </a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out mr-2  "></i>
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul> 
    
</nav>


