<?php

namespace App\Http\Controllers;
use App\Exports\Payment as ExportPayment;
use App\Exports\Transaction as ExportTransaction;
use App\Exports\Customer as ExportCustomer;
use App\Exports\Room as ExportRoom;
use App\Models\Customer;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Payment;
use Illuminate\Http\Request;
use DB;
use Auth;
use Excel;

class ReportController extends Controller
{
    

    public function index(Request $request)
    {
        return view('report.index');
    }

    public function export(Request $request){
        $from_date = $request->from_date ? $request->from_date : date('Y-m-d');
        $to_date = $request->to_date ? date('Y-m-d', strtotime($request->to_date." +1 days")) : date('Y-m-d');
        if($request->report_type == 'PAYMENT'){
            $data = DB::table('payments')->join('transactions', 'transactions.id', '=','payments.transaction_id')
                            ->join('customers', 'customers.id', '=', 'transactions.customer_id')
                            ->select('payments.price', 'payments.created_at', 'transactions.invoice_number', 'transactions.invoice_date', 'customers.name')
                            ->where('payments.created_at', '>=', $from_date)
                            ->where('payments.created_at', '<=', $to_date)
                            ->get();

            return $this->doExport('Pagos', new ExportPayment(['data' => $data]));
        }
        if($request->report_type == 'TRANSACTION'){
            $data = DB::table('transactions')->join('customers', 'customers.id', '=', 'transactions.customer_id')
                            ->join('rooms', 'rooms.id', '=', 'transactions.room_id')
                            ->select('transactions.invoice_number', 'transactions.invoice_date', 'transactions.amount', 'transactions.balance', 'customers.name', 'rooms.number')
                            ->where('transactions.invoice_date', '>=', $from_date)
                            ->where('transactions.invoice_date', '<=', $to_date)
                            ->get();
            return $this->doExport('Facturas', new ExportTransaction(['data' => $data]));
        }
        if($request->report_type == 'CUSTOMER'){
            $data = DB::table('customers')
                            ->select('customers.*')
                            ->get();

            return $this->doExport('Clientes', new ExportCustomer(['data' => $data]));
        }

        if($request->report_type == 'ROOM'){
            $data = DB::table('rooms')
                            ->select('rooms.*')
                            ->get();
            
            return $this->doExport('Habitaciones', new ExportRoom(['data' => $data]));
        }

        return redirect()->back();
    }

    protected function doExport($file_name, $exportClass){
      $date = date('Y-m-d');
      
      return Excel::download($exportClass, "${file_name}_${date}.xlsx");
    }
}
