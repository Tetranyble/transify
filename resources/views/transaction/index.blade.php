@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card mb-4">
                    <x-side_nav/>
                </div>
            </div>
            <div class="col-md-9">
                <x-alert></x-alert>
                <div class="mb-4" style="text-align: right">
                    <div class="btn-group" role="group" aria-label="Transactions type">
                        <a href="{{ route('transactions.create', ['type' => 'withdrawal']) }}"  type="button" class="btn btn-outline-secondary">Withdraw</a>
                        <a href="{{ route('transactions.create', ['type' => 'deposit']) }}" type="button" class="btn btn-outline-secondary">Deposit</a>
                        <a href="{{ route('transactions.create', ['type' => 'transfer']) }}" type="button" class="btn btn-outline-secondary">Transfer</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">{{ __('Transactions History') }}</div>

                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Type</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Account</th>
                                <th scope="col">Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($transactions as $transaction)
                                <tr>
                                    <th scope="row">{{ $transaction->id }}</th>
                                    <th scope="row">{{ $transaction->transactionType->name }}</th>
                                    <td>{{$transaction->amount}}</td>
                                    <td>{{ $transaction->account->accountType->name }}</td>
                                    <td>{{ $transaction->description }}</td>
                                </tr>
                            @empty
                                <p>No transaction records</p>
                            @endforelse

                            </tbody>
                        </table>
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
