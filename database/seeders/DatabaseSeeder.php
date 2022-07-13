<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\AccountType;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(50)->create();
        TransactionType::factory(10)->create();
        AccountType::factory(10)->create();
        $accountype = AccountType::factory()->create([
           'name' => 'saving',
            'description' => 'savings account'
        ]);
        $transactionType = TransactionType::factory()->create([
            'name' => 'deposit'
        ]);
        $transactionType = TransactionType::factory()->create([
            'name' => 'withdrawal'
        ]);
        $transactionType = TransactionType::factory()->create([
            'name' => 'transfer'
        ]);

         \App\Models\User::factory()->create([
             'firstname' => 'Leonard',
             'username' => 'leonard.ekenekiso',
             'middlename' => 'Ugbanawaji',
             'lastname' => 'Ekenekiso',
             'email' => 'e.leonard@transify.com',
         ])->each(function($user) use($transactionType, $accountype){

             $account = Account::factory()->create([
                 'user_id' => $user->id,
                 'account_type_id' => $accountype->id
             ]);
             Transaction::factory()->create([
                 'user_id' => $user->id,
                 'transaction_type_id' => $transactionType->id,
                 'account_id' => $account->id,
                 'amount' => $account->balance
             ]);
         });

        \App\Models\User::factory(50)->create()
            ->each(function($user) use($transactionType, $accountype){
                $account = Account::factory()->create([
                    'user_id' => $user->id,
                    'account_type_id' => $accountype->id
                ]);
                Transaction::factory()->create([
                    'user_id' => $user->id,
                    'transaction_type_id' => $transactionType->id,
                    'account_id' => $account->id,
                    'amount' => $account->balance
                ]);
            });
    }
}
