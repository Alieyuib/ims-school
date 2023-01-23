@section('sidebar')
<style>
    /* Dropdown Button */
.dropbtn {
background-color: transparent;
color: white !important;
/* padding: 5px; */
font-size: 16px;
border: none;
}

.dropbtn a {
    color: #f1f1f1 !important;
}
/* The container <div> - needed to position the dropdown content */
.dropdown {
position: relative;
display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
display: none;
position: absolute;
background-color: #f1f1f1;
margin-left: 0px !important;
min-width: 160px;
box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
color: black;
padding: 12px 16px;
text-decoration: none;
display: block;
}

.dropdown-item:hover{
    color: #d9ba79;
    background-color: rgba(0, 73, 73, 0.6) !important;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd;}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {display: block;}

/* Change the background color of the dropdown button when the dropdown contenbbt is shown */
.dropdown:hover .dropbtn a {background-color: none; color: #d9ba79 !important;} 
</style>
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
                                <div class="dropdown">
                                    <li class="dropbtn nav-item">
                                        <span class="link-name">
                                            <a href="#" class="nav-link text-ims-default">
                                                <span class="float-left">
                                                    <i class="fa fa-money"></i>
                                                </span>
                                                Expenses</a>
                                        </span>
                                    </li>
                                    <div class="dropdown-content" style="margin-left: -100px; width: 100%">
                                        <a class="dropdown-item" href="{{ route('expense.create') }}">New Expense</a>
                                        <a class="dropdown-item" href="{{ route('recent.expenses') }}">View Expenses</a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <li class="dropbtn nav-item">
                                        <span class="link-name">
                                            <a href="#" class="nav-link text-ims-default">
                                                <span class="float-left">
                                                    <i class="fa fa-money"></i>
                                                </span>
                                                Finance</a>
                                        </span>
                                    </li>
                                    <div class="dropdown-content" style="margin-left: -100px; width: 100%">
                                        <a class="dropdown-item" href="{{ route('dashboard.finance.generate') }}">Generate Invoice</a>
                                        {{-- <a class="dropdown-item" href="{{ route('dashboard.recent.invoice') }}">Recent Invoice</a> --}}
                                        <a class="dropdown-item" href="{{ route('dashboard.family.receipt') }}">Generate Family Receipt</a>
                                        {{--<a class="dropdown-item" href="{{ route('dashboard.finance') }}">Edit Balance</a> --}}
                                        <a class="dropdown-item" href="{{ route('dashboard.transaction.receipt.view') }}">Generate Receipt</a>
                                        <a class="dropdown-item" href="{{ route('dashboard.transaction.recent.receipt') }}">Recent Receipt</a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <li class="dropbtn nav-item">
                                        <span class="link-name">
                                            <a href="#" class="nav-link text-ims-default">
                                                <span class="float-left">
                                                    <i class="fa fa-users"></i>
                                                </span>
                                                User Management</a>
                                        </span>
                                    </li>
                                    <div class="dropdown-content" style="margin-left: -100px; width: 100%">
                                        <a class="dropdown-item" href="{{ route('dashboard.new.user') }}">Create new user</a>
                                        <a class="dropdown-item" href="{{ route('dashboard.all.users') }}">All users</a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <li class="dropbtn nav-item">
                                        <span class="link-name">
                                            <a href="#" class="nav-link text-ims-default">
                                                <span class="float-left">
                                                    <i class="fa fa-list"></i>
                                                </span>
                                                Fees</a>
                                        </span>
                                    </li>
                                    <div class="dropdown-content" style="margin-left: -100px; width: 100%">
                                        <a class="dropdown-item" href="{{ route('dashboard.new.item') }}">Add new Item</a>
                                        <a class="dropdown-item" href="{{ route('dashboard.all.item') }}">All Items</a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <li class="dropbtn nav-item">
                                        <span class="link-name">
                                            <a href="#" class="nav-link text-ims-default">
                                                <span class="float-left">
                                                    <i class="fa fa-file-photo-o"></i>
                                                </span>
                                                Pictures</a>
                                        </span>
                                    </li>
                                    <div class="dropdown-content" style="margin-left: -100px; width: 100%">
                                        <a class="dropdown-item" href="{{ route('dashboard.add.pictures') }}">Add Picture</a>
                                        <a class="dropdown-item" href="{{ route('dashboard.delete.pictures') }}">Delete Pictures</a>
                                    </div>
                                </div>
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