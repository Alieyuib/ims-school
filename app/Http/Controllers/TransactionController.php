<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student as Student;
use App\Finance as Finance;
use App\Invoice;
use App\ItemCheckout;
use App\Items;
use App\RecentInvoice;
use App\StudentFamilyAccount as StudentFamilyAccount;
use App\StudentData;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    //index function
    public function index(Request $request)
    {
        return view('dashboard.finance');
    }

    public function indexGenerate(Request $request)
    {
        return view('dashboard.generate_invoice');
    }

    public function indexEdit(Request $request)
    {
        return view('dashboard.edit_invoice');
    }

     // view receipt
     public function viewReceiptCheckout(Request $request)
     {
         $userLoggedInGuardian = $request->session()->get('loggedInGuardian');
         $loggedInFamilyName  = $request->session()->get('loggedInFamilyName');
         $loggedInEmail  = $request->session()->get('loggedInEmail');
         $loggedInAddress  = $request->session()->get('loggedInAddress');
         $student_data = StudentData::where('email', $loggedInEmail)->get();
         $view_data['family_name'] = $loggedInFamilyName;
         $view_data['family_address'] = $loggedInAddress;

        $student_account = StudentFamilyAccount::where('email', $loggedInEmail)->first();

        $view_data['balance'] = $student_account->balance;

        //  $view_data['family_address'] = $student_data->address;
         $view_data['receipt_date'] = date('D/M/Y');
         $view_data['receipt_no'] = Str::random(12);
         $view_data['students_data'] = $student_data;

         $total_student = $student_data->count();

         $view_data['total_due_amount'] = $total_student * 200000;


         return view('student_dashboard.invoice', $view_data);
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
                        <th>Invoice date</th>
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
                        <td>'.$item->created_at.'</td>
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
        $stmt = StudentFamilyAccount::all();
        $output = '';
        if ($stmt->count() > 0) {
            $output .= '<table class="table table-striped align-middle table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Account Name</th>
                        <th>Phone Number</th>
                        <th>Email Address</th>
                        <th>Balance</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';
                foreach ($stmt as $item) {
                    $output .= '<tr>
                        <td>'.$item->id.'</td>
                        <td>'.$item->account_name.'</td>
                        <td>'.$item->phone_no.'</td>
                        <td>'.$item->email.'</td>
                        <td>&#8358;'.$item->balance.'</td>
                        <td>
                            <a href="#" id="'.$item->id.'" class="mx-2 confirmIcon btn btn-ims-green" data-bs-toggle="modal" data-bs-target="#editAccountModal">Edit Balance</a>
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

     public function generateTransactionHistoryAdmin(Request $request)
     {
        // $ffname = $request->session()->get('loggedInFamilyName');
        $stmt = StudentFamilyAccount::all();
        $output = '';
        if ($stmt->count() > 0) {
            $output .= '<table class="table table-striped align-middle table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Account Name</th>
                        <th>Phone Number</th>
                        <th>Email Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';
                foreach ($stmt as $item) {
                    $output .= '<tr>
                        <td>'.$item->id.'</td>
                        <td>'.$item->account_name.'</td>
                        <td>'.$item->phone_no.'</td>
                        <td>'.$item->email.'</td>
                        <td>
                            <a href="/dashboard/generate/invoice/'.$item->id.'" id="'.$item->id.'" class="mx-2 btn btn-ims-green">Generate Invoice</a>
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

     public function editTransactionHistoryAdmin(Request $request)
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
                        <th>Invoice date</th>
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
                        <td>'.$item->created_at.'</td>
                        <td>'.$item->status.'</td>
                        <td>
                            <a href="#" id="'.$item->id.'" class="mx-2 editIcon btn btn-ims-green">Edit Invoice</a>
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

     public function getInvoiceData(Request $request)
     {
        $id = $request->id;
        $stmt = StudentFamilyAccount::find($id);

        $stmt_student = StudentData::where('email', $stmt->email)->get();

        $user_data = [
            'to_who' => $stmt->email,
            'email' => $stmt->email,
            'phone_no' => $stmt->phone_no,
            'address' => '',
            'status' => 'unpaid',
            'total' => $stmt_student->count() * 200000,
        ];

        $view_data['total_students'] = $stmt_student;

        $stmt = Invoice::create($user_data);

        if ($stmt) {
            return response()->json([
                'status' => 200,
                'data' => $stmt
            ]);
        }else{
            return response()->json([
                'status' => 300
            ]);
        };

        // return view('dashboard.invoice', $view_data);

     }

     public function getAccountBalance(Request $request)
     {
        $id = $request->id;
        $stmt = StudentFamilyAccount::find($id);
        return response()->json($stmt);
     }

     public function editAccountBalance(Request $request)
     {
        $account_email = $request->input('account_email');

        $balance = $request->input('account_balance');

        $user_data = [
            'balance' => $balance
        ];
            
        $final_stmt = StudentFamilyAccount::where('email', $account_email)->update($user_data);

        if ($final_stmt) {
            return response()->json([
                'status' => 200
            ]);
        }else {
            return response()->json([
                'status' => 300
            ]);
        }
     }

     public function getInvoice(Request $request)
     {
        $userLoggedInEmail = $request->session()->get('loggedInEmail');
        $stmt = Invoice::where('email', $userLoggedInEmail)->get();
            $output = '';
            if ($stmt->count() > 0) {
                $output .= '<table class="table table-striped align-middle table-hover">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Invoice Date</th>
                            <th>Status</th>  
                            <th>Amount</th>  
                            <th>Action</th>  
                        </tr>
                    </thead>
                    <tbody>';
                    foreach ($stmt as $item) {
                        $output .= '<tr>
                            <td>'.$item->id.'</td>
                            <td>'.$item->created_at.'</td>  
                            <td>'.$item->status.'</td>  
                            <td>&#8358;'.$item->total.'</td>  
                            <td>
                            <a href="/student/portal/transaction/'.$item->id.'" id="'.$item->id.'" class="mx-2 btn-sm btn-ims-green view-result text-ims-default text-decoration-none">View Invoice</a>
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

     public function viewInvoice(Request $request, $id)
     {
        $stmt = Invoice::find($id);
        $view_data['invoice_no'] = $stmt->id;
        $view_data['invoice_to_who'] = $stmt->to_who;
        $view_data['invoice_email'] = $stmt->email;
        $view_data['invoice_phone'] = $stmt->phone_no;
        $view_data['invoice_status'] = $stmt->status;
        $view_data['invoice_amount'] = $stmt->total;
        $view_data['invoice_created_at'] = $stmt->created_at;

        $family_members = StudentData::where('email', $stmt->email)->get();

        $view_data['family_members'] = $family_members;

        return view('dashboard.invoice', $view_data);
     }

     public function invoiceCheckout(Request $request, $id)
     {
        $item_list = Items::all();
        $student_data = StudentData::find($id);

        $view_data['student_data'] = $student_data;
        $view_data['item_list'] = $item_list;

        $view_data['order_id'] = sprintf("%06d", mt_rand(1, 999999));

        return view('dashboard.invoice_checkout', $view_data);
     }

     public function getItemPrice(Request $request)
     {
        $id = $request->id;
        $stmt = Items::find($id);

        return response()->json($stmt);
     }

     public function addItemToCart(Request $request)
     {

        $total = $request->input('item_quantity') * $request->input('item_price');

        $item_data = [
            'item_name' => $request->input('item_name'),
            'item_price' => $request->input('item_price'),
            'student_id' => $request->input('student_id'),
            'quantity' => $request->input('item_quantity'),
            'total' => $total,
            'order_id' => $request->input('order_id'),
        ];

        $stmt = ItemCheckout::create($item_data);
        if ($stmt) {
            return response()->json([
                'status' => 200,
                'data' => $stmt
            ]);
        }else{
            return response()->json([
                'status' => 300
            ]);
        };
     }

     public function getCartItem(Request $request)
     {
        $totalAll = 0;
        $counter = 1;
        $order_id = $request->order_id;
        $stmt = ItemCheckout::where('order_id', $order_id)->get();
        foreach ($stmt as $key => $value) {
            $totalAll += ($value['quantity']*$value['item_price']); // this will save your amount.
         }
            $output = '';
            if ($stmt->count() > 0) {
                $output .= '<table class="table table-striped align-middle table-hover mx-2">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Description</th>
                            <th>Quantity</th>  
                            <th>Price</th>     
                        </tr>
                    </thead>
                    <tbody>';
                    foreach ($stmt as $item) {
                        $output .= '<tr>
                            <td>'.$counter++.'</td>
                            <td>'.$item->item_name.'</td>  
                            <td>'.$item->quantity.'</td>  
                            <td>&#8358;'.number_format($item->item_price).'</td>    
                            
                        </tr>';
                    }

                    $output .= '<tr><td><h5>Total Of &#8358;'.number_format($totalAll).'</h5></td> <tr></tbody></table>';
                    echo $output;
            }else{
                echo '<h1 class="text-center text-secondary my-5">
                    No records present in the database
                </h1>';
            }
     }


     public function generateInvoice(Request $request)
     {
        $img = $request->img;
        $order_id = $request->order_id;
        $student_email = $request->student_email;

        $extension = explode('/', explode(':', substr($img, 0, strpos($img, ';')))[1])[1];   // .jpg .png .pdf
        $replace = substr($img, 0, strpos($img, ',')+1); 

        // find substring fro replace here eg: data:image/png;base64,

        $image = str_replace($replace, '', $img); 
        $image = str_replace(' ', '+', $image); 

        $imageName = $order_id.'.'.$extension;

        Storage::disk('public')->put($imageName, base64_decode($image));

        $invoice_data = [
            'invoice_id' => $order_id,
            'invoice' => $imageName,
            'student_email' => $student_email
        ];

        $stmt = RecentInvoice::create($invoice_data);
        if ($stmt) {
            return response()->json([
                'status' => 200
            ]);
        }else{
            return response()->json([
                'status' => 400
            ]);
        }
     }

     public function recentInvoice()
     {
        $view_data['recent_invoice'] = RecentInvoice::all();
        $view_data['counter'] = 1;
        return view('dashboard.recent_invoice', $view_data);
     }
 
}
