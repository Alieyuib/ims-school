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
                                    Student Enrollment</a>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span class="link-name">
                                <a href="{{ route('dashboard.grade.students') }}">
                                    <span class="float-left">
                                        <i class="fa fa-book"></i>
                                    </span>
                                    Grade Students</a>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span class="float-left">
                                <i class="fa fa-bar-chart"></i>
                            </span>
                            <span class="link-name">
                                Students Result
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
                </div>
            </div>
@endsection