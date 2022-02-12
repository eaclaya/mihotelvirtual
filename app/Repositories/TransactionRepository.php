<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\Room;
use App\Models\Transaction;
use Carbon\Carbon;
use DB;
class TransactionRepository
{
    public function store($request, Customer $customer, Room $room)
    {
        $transaction = Transaction::create([
            'user_id' => auth()->user()->id,
            'customer_id' => $customer->id,
            'room_id' => $room->id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'status' => 'Reservation'
        ]);
        
        $transaction->amount = $transaction->getTotalPrice();
        $transaction->balance = $transaction->amount;
        $transaction->save();
        
        return $transaction;
    }

    public function getTransaction($request)
    {
        // $transactions = Transaction::with('user', 'room', 'customer')->where('check_out', '>=', Carbon::now());
        $transactions = DB::table('transactions')->join('customers', 'customers.id', '=', 'transactions.customer_id')
                            ->join('rooms', 'rooms.id', '=', 'transactions.room_id')
                            ->select('transactions.*', 'customers.name' ,'rooms.number')
                            ->where('transactions.check_out', '>=', Carbon::now());
        // if (!empty($request->search)) {
        //     $transactions = $transactions->where('id', '=', $request->search);
        // }
        if (!empty($request->search)) {
            $search = $request->search;
            $transactions = $transactions->where(function($query) use ($search){
                $query->where('rooms.number', $search)
                        ->orWhere('customers.name', 'like', "%$search%");

            });
        }
        $transactions = $transactions->orderBy('transactions.check_out', 'ASC')->orderBy('transactions.id', 'DESC')->paginate(50);
        $transactions->appends($request->all());

        return $transactions;
    }

    public function getTransactionExpired($request)
    {
        $transactionsExpired = Transaction::with('user', 'room', 'customer')->where('check_out', '<', Carbon::now());

        if (!empty($request->search)) {
            $transactionsExpired = $transactionsExpired->where('id', '=', $request->search);
        }

        $transactionsExpired = $transactionsExpired->orderBy('check_out', 'ASC')->paginate(50);
        $transactionsExpired->appends($request->all());

        return $transactionsExpired;
    }


}
