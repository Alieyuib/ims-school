@section('sidebar')
    <div class="ims-sidebar">
        <div class="sidebar-header">
            <h5>The Priority School</h5>
        </div>
        <div class="sidebar-links">
            <ul class="list-group" style="margin-left: 20px">
                <li class="list-group-item">
                    <span class="link-name">
                        <a href="{{ route('portal.dashboard') }}">
                            <span class="float-left">
                                <i class="fa fa-dashboard"></i>
                            </span>
                            &nbsp;Dashboard</a>
                    </span>
                </li>
                <li class="list-group-item">
                    <span class="link-name">
                        <a href="{{ route('portal.teacher.grade') }}">
                            <span class="float-left">
                                <i class="fa fa-users"></i>
                            </span>
                            &nbsp;All Students</a>
                    </span>
                </li>
                @can('get_results')
                    <li class="list-group-item">
                        <span class="link-name">
                            <a href="{{ route('portal.teacher.results') }}">
                                <span class="float-left">
                                    <i class="fa fa-users"></i>
                                </span>
                                &nbsp;All Students</a>
                        </span>
                    </li>
                @endcan
                <li class="list-group-item">
                    <span class="link-name">
                        <a href="{{ route('teacher.logout') }}">
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
