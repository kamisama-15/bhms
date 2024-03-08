<aside class="main-sidebar sidebar-dark-primary elevation-4"> 
    <a href="#" target="_BLANK" class="brand-link">
        <img src="{{ asset('assets/images/bh_logo.jpg') }}" alt="School Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">BHMS</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image"> 
                <img src="{{ asset('../assets/images/logo.png') }}" class="img-circle elevation-2" style="width:30px;height:30px;" alt="User Image"> 
            </div> 
            <div class="info">
                <a href="" class="d-block">{{Auth::user()->first_name}}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

               
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <!-- Navigation items -->
                    <li class="nav-item">
                        <a href="{{ route('home') }}" id="home-link" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
                            <i class="fas fa-home nav-icon"></i>
                            <p>Home</p>
                        </a>
                    </li>

                    @if(Auth::user()->user_type == 'student')
                        <li class="nav-item">
                            <a href="{{ route('boardinghouse') }}" class="nav-link {{ Request::is('boardinghouse') ? 'active' : '' }}">
                                <i class="fas fa-file nav-icon"></i>
                                <p>Boarding House</p>
                            </a>
                        </li>
                    @endif
                    <!-- @if(Auth::user()->user_type == 'homeowner')
                    <li class="nav-item">
                        <a href="{{ route('pay') }}" class="nav-link {{ Request::is('pay') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p> Boarders</p>
                        </a>
                    </li>
                    @endif -->
                    @if(Auth::user()->user_type == 'homeowner')
                    <li class="nav-item">
                        <a href="{{ route('rooms') }}" class="nav-link {{ Request::is('rooms') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-bed"></i>
                            <p> Rooms</p>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->user_type == 'homeowner')
                    <li class="nav-item">
                        <a href="{{ route('post') }}" class="nav-link {{ Request::is('post') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-sticky-note-o"></i>
                            <p> Post</p>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->user_type == 'homeowner')
                    <li class="nav-item">
                        <a href="{{ route('pay') }}" class="nav-link {{ Request::is('pay') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-money"></i>
                            <p> Payment</p>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->user_type == 'admin')
                    <li class="nav-item">
                        <a href="{{ route('houseowners') }}" class="nav-link {{ Request::is('houseowners') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-money"></i>
                            <p> House Owners</p>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->user_type == 'admin')
                    <li class="nav-item">
                        <a href="{{ route('students') }}" class="nav-link {{ Request::is('students') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-money"></i>
                            <p> Students</p>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->user_type == 'homeowner')
                    <li class="nav-item">
                        <a href="{{ route('boarders') }}" class="nav-link {{ Request::is('boarders') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p> Boarders</p>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->user_type == 'student')
                    <li class="nav-item">
                        <a href="{{ route('receipt') }}" class="nav-link {{ Request::is('receipt') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-receipt"></i>
                            <p> Receipt</p>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->user_type == 'student')
                    <li class="nav-item">
                        <a href="{{ route('boardersreservation') }}" class="nav-link {{ Request::is('boardersreservation') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p> Reservations</p>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->user_type == 'student')
                    <li class="nav-item">
                        <a href="{{ route('studentboarders') }}" class="nav-link {{ Request::is('studentboarders') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p> Boarding House</p>
                        </a>
                    </li>
                    @endif
                </ul>
            </nav>

              
            </ul>
        </nav>
    </div>
</aside>



