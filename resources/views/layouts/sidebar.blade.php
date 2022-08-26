@section('sidebar')
    <div class="ims-sidebar">
                <div class="sidebar-header">
                    <h5>The Priority School</h5>
                </div>
                <div class="sidebar-links">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="link-name">
                                <a href="{{ route('dashboard') }}">
                                    <span class="float-left">
                                        <i class="fa fa-dashboard"></i>
                                    </span>
                                    Dashboard</a>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span class="link-name">
                                <a href="{{ route('fetch.students') }}">
                                    <span class="float-left">
                                        <i class="fa fa-users"></i>
                                    </span>
                                    Students</a>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span class="link-name">
                                <a href="{{ route('dashboard-new-student') }}">
                                    <span class="float-left">
                                        <i class="fa fa-user-plus"></i>
                                    </span>
                                    Student Registration</a>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span class="link-name">
                                <a href="{{ route('dashboard-enroll-student') }}">
                                    <span class="float-left">
                                        <i class="fa fa-user-plus"></i>
                                    </span>
                                    Student Enrollment</a>
                            </span>
                        </li>
                        {{-- <li class="list-group-item">
                            <span class="link-name">
                                <a href="{{ route('dashboard.grade.students') }}">
                                    <span class="float-left">
                                        <i class="fa fa-bookmark"></i>
                                    </span>
                                    Grade Students</a>
                            </span>
                        </li> --}}
                        <li class="list-group-item">
                            <span class="link-name">
                                <a href="{{ route('dashboard.record') }}">
                                    <span class="float-left">
                                        <i class="fa fa-bar-chart"></i>
                                    </span>
                                    Student Result</a>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span class="link-name">
                                <a href="{{ route('dashboard.books') }}">
                                    <span class="float-left">
                                        <i class="fa fa-book"></i>
                                    </span>
                                    Books</a>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span class="link-name">
                                <a href="{{ route('dashboard.get.idcard') }}">
                                    <span class="float-left">
                                        <i class="fa fa-vcard"></i>
                                    </span>
                                    Generate ID Card</a>
                            </span>
                        </li>
                        <div class="dropdown">
                            <li class="list-group-item dropdown-toggle" data-bs-toggle="dropdown">
                                <span class="link-name">
                                    <a href="">
                                        <span class="float-left">
                                            <i class="fa fa-money"></i>
                                        </span>
                                        Finance</a>
                                </span>
                            </li>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('dashboard.finance.generate') }}">Generate Invoice</a></li>
                                <li><a class="dropdown-item" href="{{ route('dashboard.recent.invoice') }}">Recent Invoice</a></li>
                                <li><a class="dropdown-item" href="{{ route('dashboard.finance') }}">Edit Balance</a></li>
                                {{-- <li><a class="dropdown-item" href="{{ route('dashboard.finance.edit') }}">Student/Family Account</a></li> --}}
                                {{-- <li><a class="dropdown-item" href="#">Link 3</a></li> --}}
                            </ul>
                        </div>
                        <div class="dropdown">
                            <li class="list-group-item dropdown-toggle" data-bs-toggle="dropdown">
                                <span class="link-name">
                                    <a href="">
                                        <span class="float-left">
                                            <i class="fa fa-users"></i>
                                        </span>
                                        User Management</a>
                                </span>
                            </li>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('dashboard.new.user') }}">Create new user</a></li>
                                <li><a class="dropdown-item" href="{{ route('dashboard.all.users') }}">All users</a></li>
                                {{-- <li><a class="dropdown-item" href="{{ route('dashboard.all.users') }}">Edit Invoice</a></li> --}}
                                {{-- <li><a class="dropdown-item" href="#">Link 3</a></li> --}}
                            </ul>
                        </div>
                        <div class="dropdown">
                            <li class="list-group-item dropdown-toggle" data-bs-toggle="dropdown">
                                <span class="link-name">
                                    <a href="">
                                        <span class="float-left">
                                            <i class="fa fa-list"></i>
                                        </span>
                                        Products</a>
                                </span>
                            </li>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('dashboard.new.item') }}">Add new Product</a></li>
                                <li><a class="dropdown-item" href="{{ route('dashboard.all.item') }}">All Products</a></li>
                                {{-- <li><a class="dropdown-item" href="{{ route('dashboard.all.users') }}">Edit Invoice</a></li> --}}
                                {{-- <li><a class="dropdown-item" href="#">Link 3</a></li> --}}
                            </ul>
                        </div>
                        <li class="list-group-item">
                            <span class="link-name">
                                <a href="{{ route('logout') }}">
                                    <span class="float-left">
                                        <i class="fa fa-sign-out"></i>
                                    </span>
                                    Logout</a>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
@endsection