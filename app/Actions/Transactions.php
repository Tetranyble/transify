<?php


namespace App\Actions;


use App\Models\Account;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Support\Facades\DB;

class Transactions
{
    public function handle($request){

        if(!in_array($request->type, ['withdrawal', 'deposit', 'transfer'])) {
            return redirect()->route('transactions.create')->with('error', 'Transaction type is unauthorized.');
        }


        return DB::transaction(function() use($request){
            $account = Account::whereId($request->account_id)->first();
            if ($request->type === 'withdrawal'){
                if($request->amount > $account->balance){
                    return redirect()->route('transactions.create')->with('error', 'Requested withdrawal amount exceeds available account balance.');
                }
                Transaction::create($request->merge(['previous_balance' => $account->balance])->all());
                $account->update(['balance' => $account->balance - $request->amount]);
            }elseif ($request->type === 'deposit'){
                Transaction::create($request->merge(['previous_balance' => $account->balance])->all());
                $account->update(['balance' => $account->balance + $request->amount]);
            }elseif ($request->type === 'transfer'){
                if($request->amount > $account->balance){
                    return redirect()->route('transactions.create')->with('error', 'Requested withdrawal amount exceeds available account balance.');
                }
                Transaction::create($request->merge(['previous_balance' => $account->balance])->all());
                $account->update(['balance' => $account->balance - $request->amount]);

                $receiver = Account::where('account_number',$request->receiver)->first();
                $transaction = TransactionType::whereName($request->type)->first();
                Transaction::create([
                    'user_id' => $receiver->user_id,
                    'previous_balance' => $receiver->balance,
                    'account_id' => $receiver->id,
                    'amount' => $request->amount,
                    'description' => $request->description,
                    'transaction_type_id' => $transaction->id
                ]);
                $receiver->update(['balance' => $receiver->balance + $request->amount]);
            }
        });
    }

}
