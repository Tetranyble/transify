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
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" onclick="checkHandler('withdrawal')" class="btn-check" name="type" id="btnradio1" autocomplete="off" @if(request()->query('type') ==='withdrawal') checked @endif>
                        <label class="btn btn-outline-primary" for="btnradio1">Withdrawal</label>

                        <input type="radio" onclick="checkHandler('deposit')" class="btn-check" name="type" id="btnradio2" autocomplete="off" @if(request()->query('type') ==='deposit') checked @endif>
                        <label class="btn btn-outline-primary" for="btnradio2">Deposit</label>

                        <input type="radio" onclick="checkHandler('transfer')" class="btn-check" name="type" id="btnradio3" autocomplete="off" @if(request()->query('type') ==='transfer') checked @endif>
                        <label class="btn btn-outline-primary" for="btnradio3">Transfer</label>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">{{ __(ucfirst(request()->query('type'))) }}</div>

                    <div class="card-body">
                        <form class="row g-3" method="POST" action="{{ route('transactions.store', ['type' => request()->query('type')]) }}">
                            @csrf
                            <div class="col-md-12 d-none" id="account" >
                                <label for="receiver" class="form-label">Account Number <span  class="text-danger h6">{{$errors->first('receiver')}}</span></label>
                                <input value="{{ old('receiver') }}" name="receiver" type="text" class="form-control" id="receiver" autocomplete="off">
                            </div>
                            <div class="col-md-12">
                                <label for="amount" class="form-label">Amount <span  class="text-danger h6">{{$errors->first('amount')}}</span></label>
                                <input value="{{ old('amount') }}" type="text" name="amount" class="form-control" id="amount" autofocus="true" autocomplete="off">
                            </div>
                            <div class="col-md-12">
                                <label for="description" class="form-label">Description <span  class="text-danger h6">{{$errors->first('description')}}</span></label>
                                <input value="{{ old('description') }}" name="description" type="text" class="form-control" id="description" autocomplete="off">
                            </div>
                            <div class="col-12" style="text-align: right">
                                <button type="submit" class="btn btn-outline-success">Proceed with {{ request()->query('type') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.checkHandler = function(event){
            var searchParams = new URLSearchParams(window.location.search)
            searchParams.set("type", event);
            document.querySelector('[type="submit"]').innerHTML = 'Proceed with ' + event;
            var newRelativePathQuery = window.location.pathname + '?' + searchParams.toString();
            history.pushState(null, '', newRelativePathQuery);
            if (event === 'transfer'){
                document.querySelector('#account').classList.remove('d-none')
            }else{
                document.querySelector('#account').classList.add('d-none');
            }
        }
        window.addEventListener('DOMContentLoaded', function(){
            var type = new URLSearchParams(window.location.search).get('type');
            if (type === 'transfer'){
                document.querySelector('#account').classList.remove('d-none');
            }
        })
    </script>
@endsection
