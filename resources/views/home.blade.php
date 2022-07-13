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
            <div class="row justify-content-center mb-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <h3 class="card-title fw-bold">{{ money($account->balance) }}</h3>
                                <h6 class="card-subtitle mb-2 text-muted">Account Balance</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <h3 class="card-title fw-bold">{{ money($t_volume) }}</h3>
                                <h6 class="card-subtitle mb-2 text-muted">Transaction Volume</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Most recent transactions') }}</div>

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
