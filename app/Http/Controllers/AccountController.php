<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use App\Repositories\AccountRepository;
use App\Repositories\ImageRepository;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    private $accountRepository;

    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function index(Request $request)
    {
        $account = $this->accountRepository->find($request);

        return view('setting.account', compact('account'));
    }

    public function create()
    {
        return view('setting.account');
    }

    public function store(Request $request)
    {
        $account = $this->accountRepository->store($request);
        return redirect('account')->with('success', 'Cuenta ' . $account->name . ' created');
    }

    public function update(Request $request)
    {
        $account = $this->accountRepository->store($request);
        return redirect('account')->with('success', 'Cuenta ' . $account->name . ' updated');
    }
    
}
