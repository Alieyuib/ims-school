<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student as Student;
use App\Finance as Finance;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    //index function
    public function index(Request $request)
    {
        return view('dashboard.finance');
    }

     // view receipt
     public function viewReceiptCheckout(Request $request)
     {
         $userLoggedInGuardian = $request->session()->get('loggedInGuardian');
         $loggedInFamilyName  = $request->session()->get('loggedInFamilyName');
         $loggedInAddress  = $request->session()->get('loggedInAddress');
         $student_data = Student::where('guardian', $userLoggedInGuardian)->get();
         $view_data['family_name'] = $loggedInFamilyName;
         $view_data['family_address'] = $loggedInAddress;
        //  $view_data['family_address'] = $student_data->address;
         $view_data['receipt_date'] = date('D/M/Y');
         $view_data['receipt_no'] = Str::random(12);
         $view_data['students_data'] = $student_data;

         $total_student = $student_data->count();

         $view_data['total_due_amount'] = $total_student * 200000;


         return view('student_dashboard.checkout', $view_data);
     }

     public function checkout(Request $request)
     {
        $amount_to_pay = $request->input('amount_to_pay');
        $amount_to_paid = $request->input('amount_to_paid');

        $ffname = $request->session()->get('loggedInFamilyName');
        $userLoggedInEmail = $request->session()->get('loggedInEmail');
        $balance = $amount_to_paid - $amount_to_pay;
        $status = 'pending';
        $invoice_no = Str::random(12);

        $finance_data = [
            'ffname' => $ffname,
            'amount_to_pay' => $amount_to_pay,
            'amount_paid' => $amount_to_paid,
            'balance' => $balance,
            'status' => $status,
            'invoice_no' => $invoice_no,
            'family_email' => $userLoggedInEmail
        ];

        $stmt = Finance::create($finance_data);

        if ($stmt) {
            return response()->json([
                'status' => 200,
                'data' => $stmt,
                'email' => $userLoggedInEmail,
            ]);
        }else{
            return response()->json([
                'status' => 400
            ]);
        }
     }

     public function transactionHistoryView(Request $request)
     {
        return view('student_dashboard.transaction_history');
     }

     public function transactionHistory(Request $request)
     {
        $ffname = $request->session()->get('loggedInFamilyName');
        $stmt = Finance::where('ffname', $ffname)->get();
        $output = '';
        if ($stmt->count() > 0) {
            $output .= '<table class="table table-striped align-middle table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Family Name</th>
                        <th>Amount to pay</th>
                        <th>Amount Paid</th>
                        <th>Balance</th>
                        <th>Invoice number</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>';
                foreach ($stmt as $item) {
                    $output .= '<tr>
                        <td>'.$item->id.'</td>
                        <td>'.$item->ffname.'</td>
                        <td>'.$item->amount_to_pay.'</td>
                        <td>'.$item->amount_paid.'</td>
                        <td>'.$item->balance.'</td>
                        <td>'.$item->invoice_no.'</td>
                        <td>'.$item->status.'</td>
                    </tr>';
                }

                $output .= '</tbody></table>';
                echo $output;
        }else{
            echo '<h1 class="text-center text-secondary my-5">
                No records present in the database
            </h1>';
        }
     }

     public function transactionHistoryAdmin(Request $request)
     {
        // $ffname = $request->session()->get('loggedInFamilyName');
        $stmt = Finance::all();
        $output = '';
        if ($stmt->count() > 0) {
            $output .= '<table class="table table-striped align-middle table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Family Name</th>
                        <th>Amount to pay</th>
                        <th>Amount Paid</th>
                        <th>Balance</th>
                        <th>Invoice number</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';
                foreach ($stmt as $item) {
                    $output .= '<tr>
                        <td>'.$item->id.'</td>
                        <td>'.$item->ffname.'</td>
                        <td>'.$item->amount_to_pay.'</td>
                        <td>'.$item->amount_paid.'</td>
                        <td>'.$item->balance.'</td>
                        <td>'.$item->invoice_no.'</td>
                        <td>'.$item->status.'</td>
                        <td>
                            <a href="#" id="'.$item->id.'" class="mx-2 confirmIcon"><i class="fa fa-check-square text-secondary"></i></a>
                            <a href="#" id="'.$item->id.'" class="mx-2 deleteIcon"><i class="bi-trash text-warning"></i></a>
                        </td>
                    </tr>';
                }

                $output .= '</tbody></table>';
                echo $output;
        }else{
            echo '<h1 class="text-center text-secondary my-5">
                No records present in the database
            </h1>';
        }
     }

     public function confirmTransaction(Request $request)
     {
        $transaction_id = $request->id;

        $transaction_status = 'Paid';

        $transaction_data = [
            'status' => $transaction_status,
        ];

        $stmt_data = Finance::find($transaction_id);

        $invoice_no = $stmt_data->invoice_no;

        $stmt = Finance::where('id', $transaction_id)->update($transaction_data);

        if ($stmt) {
            return response()->json([
                'status' => 200,
                'transaction_id' => $transaction_id,
                'invoice_no' => $invoice_no
            ]);
        }else{
            return response()->json([
                'status' => 300
            ]);
        }
     }
 
}
