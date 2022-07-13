<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = auth()->user()->id;
        $account = Account::whereUserId($user)->first();
        $t_volume = Transaction::whereUserId($user)->get()->sum('amount');
        $transactions = Transaction::with('transactionType', 'account')
            ->where('user_id', $user)->latest()->paginate(10);
        return view('home', compact('transactions', 'account', 't_volume'));
    }
}
