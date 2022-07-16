@section('sidebar')
    <div class="ims-sidebar">
                <div class="sidebar-header">
                    <h5>The Priority School</h5>
                </div>
                <div class="sidebar-links">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="link-name">
                                <a href="">
                                    <span class="float-left">
                                        <i class="fa fa-dashboard"></i>
                                    </span>
                                    Dashboard</a>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span class="link-name">
                                <a href="{{ route('portal.results') }}">
                                    <span class="float-left">
                                        <i class="fa fa-bookmark"></i>
                                    </span>
                                    Check Result</a>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span class="link-name">
                                <a href="">
                                    <span class="float-left">
                                        <i class="fa fa-vcard"></i>
                                    </span>
                                    Updated Bio Data</a>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span class="link-name">
                                <a href="">
                                    <span class="float-left">
                                        <i class="fa fa-book"></i>
                                    </span>
                                    Courses</a>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span class="float-left">
                                <i class="fa fa-money"></i>
                            </span>
                            <span class="link-name">
                                Finance
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
@endsection
