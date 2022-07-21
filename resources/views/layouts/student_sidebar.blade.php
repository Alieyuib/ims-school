@section('sidebar')
    <div class="ims-sidebar">
                <div class="sidebar-header">
                    <h5>The Priority School</h5>
                </div>
                <div class="sidebar-links">
                    <ul class="list-group bg-success">
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
                                <a href="{{ route('portal.results') }}">
                                    <span class="float-left">
                                        <i class="fa fa-bookmark"></i>
                                    </span>
                                    &nbsp;Check Result</a>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span class="link-name">
                                <a href="{{ route('portal.biodata') }}">
                                    <span class="float-left">
                                        <i class="fa fa-vcard"></i>
                                    </span>
                                    &nbsp;Updated Bio Data</a>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span class="link-name">
                                <a href="">
                                    <span class="float-left">
                                        <i class="fa fa-book"></i>
                                    </span>
                                    &nbsp;Courses</a>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span class="link-name">
                                <a href="{{ route('portal.finance') }}">
                                    <span class="float-left">
                                        <i class="fa fa-money"></i>
                                    </span>
                                    &nbsp;Finance</a>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
@endsection
