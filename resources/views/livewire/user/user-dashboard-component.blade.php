<div>
    <style>
        .no-decoration {
            list-style-type: none;
        }

    </style>
    <h1>User Dashboard</h1>
    <div class="container-fluid">
        <div class="topbar-menu-area">
            <div class="container">
                <div class="topbar-menu">
                    <li class="menu-item menu-item-has-children parent no-decoration text-black">
                        <a title="My Account" style="color: #000000 !important;" href="#">Settings
                            ({{ Auth::user()->name }})<i class="fa fa-angle-down " aria-hidden="true"></i></a>
                        <ul class="submenu curency">
                            <li class="menu-item">
                                <a title="Change Password" href="{{ route('user.changepassword') }}">Change
                                    Password</a>
                            </li>
                            <form id="logout-form" method="POST" action="{{ route('logout') }}">
                                @csrf
                            </form>
                        </ul>
                    </li>
                </div>
            </div>
        </div>
    </div>


</div>
