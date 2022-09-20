@section('sidebar')
    <div class="ims-sidebar">
                <div class="sidebar-header">
                    <h5>The Priority School</h5>
                </div>
                <div class="sidebar-links">
                    @role('super_admin')
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
                                    <li><a class="dropdown-item" href="{{ route('dashboard.family.receipt') }}">Generate Family Receipt</a></li>
                                    {{-- <li><a class="dropdown-item" href="{{ route('dashboard.finance') }}">Edit Balance</a></li> --}}
                                    <li><a class="dropdown-item" href="{{ route('dashboard.transaction.receipt.view') }}">Generate Receipt</a></li>
                                    <li><a class="dropdown-item" href="{{ route('dashboard.transaction.recent.receipt') }}">Recent Receipt</a></li>
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
                                            Fees</a>
                                    </span>
                                </li>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('dashboard.new.item') }}">Add new Item</a></li>
                                    <li><a class="dropdown-item" href="{{ route('dashboard.all.item') }}">All Items</a></li>
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
                    @else
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
                            @role('can_access_class_1')
                                <li class="list-group-item">
                                    <span class="link-name">
                                        <a href="{{ route('class_one') }}">
                                            <span class="float-left">
                                                <i class="fa fa-users"></i>
                                            </span>
                                            Students Class 1</a>
                                    </span>
                                </li>
                            @endrole
                            @role('can_access_class_2')
                                <li class="list-group-item">
                                    <span class="link-name">
                                        <a href="{{ route('class_two') }}">
                                            <span class="float-left">
                                                <i class="fa fa-users"></i>
                                            </span>
                                            Students Class 2</a>
                                    </span>
                                </li>
                            @endrole
                            @role('can_access_class_3')
                                <li class="list-group-item">
                                    <span class="link-name">
                                        <a href="{{ route('class_three') }}">
                                            <span class="float-left">
                                                <i class="fa fa-users"></i>
                                            </span>
                                            Students Class 3</a>
                                    </span>
                                </li>
                            @endrole
                            @role('can_access_class_4')
                                <li class="list-group-item">
                                    <span class="link-name">
                                        <a href="{{ route('class_four') }}">
                                            <span class="float-left">
                                                <i class="fa fa-users"></i>
                                            </span>
                                            Students Class 4</a>
                                    </span>
                                </li>
                            @endrole
                            @role('can_access_class_hadaanah')
                                <li class="list-group-item">
                                    <span class="link-name">
                                        <a href="{{ route('class_hadaanah') }}">
                                            <span class="float-left">
                                                <i class="fa fa-users"></i>
                                            </span>
                                            Students Hadaanah</a>
                                    </span>
                                </li>
                            @endrole
                            @role('can_access_class_faslul_hifiz')
                                <li class="list-group-item">
                                    <span class="link-name">
                                        <a href="{{ route('class_fashul_hifiz') }}">
                                            <span class="float-left">
                                                <i class="fa fa-users"></i>
                                            </span>
                                            Students Faslul hifiz</a>
                                    </span>
                                </li>
                            @endrole
                            @role('can_access_class_arraudatul_ola')
                                <li class="list-group-item">
                                    <span class="link-name">
                                        <a href="{{ route('class_arraudatul_ola') }}">
                                            <span class="float-left">
                                                <i class="fa fa-users"></i>
                                            </span>
                                            Students Arraudatul Ola</a>
                                    </span>
                                </li>
                            @endrole
                            @role('can_access_class_arrauda_ath_thaaniya')
                                <li class="list-group-item">
                                    <span class="link-name">
                                        <a href="{{ route('class_arrauda_thaaniya') }}">
                                            <span class="float-left">
                                                <i class="fa fa-users"></i>
                                            </span>
                                            Students Arrauda Thaaniya</a>
                                    </span>
                                </li>
                            @endrole
                            @role('finance_rep')
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
                            @endrole
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
                    @endrole
                </div>
            </div>
@endsection