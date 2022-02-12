<?php

namespace App\Repositories;

use App\Models\Account;
use Illuminate\Support\Str;

class AccountRepository
{
   public function find($request){
        $accountId = $request->account_id ? $request->account_id : 1;
        $account = Account::find($accountId);
        if(!$account){
            $account = new Account();
        }
        return $account;
   }

   public function store($request){
        $accountId = $request->account_id ? $request->account_id : 1;
        $account = Account::find($accountId);
        if(!$account){
            $account = new Account();
        }
        $account->name = $request->name;
        $account->phone = $request->phone;
        $account->email = $request->email;
        $account->phone = $request->phone;
        $account->vat_number = $request->vat_number;
        $account->address = $request->address;

        if ($request->hasFile('logo')) {
            $path = 'img/account';
            $path = public_path($path);
            $file = $request->file('logo');
            $imageRepository = new ImageRepository;
            $imageRepository->uploadImage($path, $file);
            $account->logo = $file->getClientOriginalName();
        }
        $account->save();
        return $account;
   }
}
