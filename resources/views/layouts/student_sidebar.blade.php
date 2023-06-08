@section('sidebar')
    <div class="ims-sidebar">
                <div class="sidebar-header">
                    <h5>The Priority School</h5>
                </div>
                <div class="sidebar-links">
                    <ul class="list-group" style="margin-left: 20px">
                        {{-- <li class="list-group-item">
                            <span class="link-name">
                                <a href="{{ route('portal.dashboard') }}">
                                    <span class="float-left">
                                        <i class="fa fa-dashboard"></i>
                                    </span>
                                    &nbsp;Dashboard</a>
                            </span>
                        </li> --}}
                        {{-- <li class="list-group-item">
                            <span class="link-name">
                                <a href="{{ route('portal.results') }}">
                                    <span class="float-left">
                                        <i class="fa fa-bookmark"></i>
                                    </span>
                                    &nbsp;Check Result</a>
                            </span>
                        </li> --}}
                        {{-- <li class="list-group-item">
                            <span class="link-name">
                                <a href="{{ route('portal.biodata') }}">
                                    <span class="float-left">
                                        <i class="fa fa-users"></i>
                                    </span>
                                    &nbsp;Members</a>
                            </span>
                        </li> --}}
                        <li class="list-group-item">
                            <span class="link-name">
                                <a href="{{ route('portal.course.registration') }}">
                                    <span class="float-left">
                                        <i class="fa fa-bar-chart"></i>
                                    </span>
                                    &nbsp;View Result</a>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span class="link-name">
                                <a href="{{ route('portal.get.books') }}">
                                    <span class="float-left">
                                        <i class="fa fa-book"></i>
                                    </span>
                                    &nbsp;E-Books</a>
                            </span>
                        </li>
                        {{-- <li class="list-group-item">
                            <span class="link-name">
                                <a href="{{ route('portal.finance') }}">
                                    <span class="float-left">
                                        <i class="fa fa-money"></i>
                                    </span>
                                    &nbsp;Finance</a>
                            </span>
                        </li> --}}
                        <li class="list-group-item">
                            <span class="link-name">
                                <a href="{{ route('portal.logout') }}">
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
