@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="card p-2 family-profile">
            <div class="row">
                <h5 class="text-center text-ims-default text-uppercase">List of family members</h5>
                @foreach ($students_bio as $item)
                    <div class="col-md-4 mb-5 mt-2">
                        <div class="card shadow p-2">
                            <p class="text-ims-default"><b class="text-ims-orange mx-2">Name:</b>{{ $item->name }}</p>
                            <p class="text-ims-default"><b class="text-ims-orange mx-2">Current class:</b>{{ $item->current_class }}</p>
                            <p class="text-ims-default"><b class="text-ims-orange mx-2">Family name:</b>{{ $item->ffname }}</p>
                        </div>
                    </div>
                @endforeach
                {{-- <h5 class="text-center text-ims-default text-uppercase">Family profile</h5> --}}
                {{-- @foreach ($student_bio as $item) --}}
                    <div class="col-md-12 mb-4">
                        <div class="card shadow p-2 mt-2">
                            <a href="/dashboard/invoice/family/{{$student_bio->email}}" class="text-uppercase btn btn-ims-green">
                                Generate invoice
                            </a>
                            <a href="/dashboard/invoice/recent/{{$student_bio->email}}" class="text-uppercase mt-2 btn btn-ims-orange">
                                View recent invoice
                            </a>
                            <a href="/dashboard/receipt/recent/{{$item->email}}" class="text-uppercase mt-2 btn btn-ims-orange">
                                View recent receipt
                            </a>
                        </div>
                    </div> 
                {{-- @endforeach --}}
                <div class="col-md-4 mb-4">
                    <div class="card shadow p-2">
                        <p class="fs-4 text-center text-ims-orange text-uppercase">Balance</p>
                        <p class="fs-4 text-center text-ims-default text-uppercase">
                            @if ($student_bio->balance > 0)
                                &#8358; -{{number_format($student_bio->balance)}}
                            @else
                                &#8358; -0
                            @endif
                        </p>
                    </div>
                </div>
                <div class="col-md-8 mb-4">
                    <div class="card shadow p-2">
                        <p class="text-ims-default text-center">Transactions by {{$student_bio->email}}</p>
                        <p class="text-center">
                            <a href="/dashboard/new/transaction/{{$student_bio->id}}/{{$student_bio->email}}" class="btn btn-ims-green btn-sm mt-2">
                                Add new transaction
                            </a>
                            <a href="/dashboard/edit/balance/{{$student_bio->email}}" class="btn btn-ims-green btn-sm mt-2">
                               Edit balance
                            </a>
                        </p>
                        <div class="transactions">
                            <table class="table table-stripped table-hover">
                                <thead>
                                    <tr class="text-ims-default">
                                        <th>Id</th>
                                        <th>Amount</th>
                                        <th>Remarks</th>
                                        <th>Ref</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaction_list as $transaction)
                                        <tr>
                                            <td>{{$transaction->id}}</td>
                                            <td>&#8358; {{number_format($transaction->amount)}}</td>
                                            <td>{{$transaction->remarks}}</td>
                                            <td>{{$transaction->trans_id}}</td>
                                            <td>{{$transaction->created_at}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        $('table').DataTable({
            order: [0, 'desc'],
            scrollY: true,
        });
        
        function printReceipt(el){
          var restorepage = $('body').html();
          var printcontent = $('#' + el).clone();
          $('body').empty().html(printcontent);
          window.print();
          $('body').html(restorepage);
        }

        $('#print_btn').on("click", function(el){
            printReceipt('invoice')
        })
        
    </script>
@endsection
{{-- </body>
</html> --}}

