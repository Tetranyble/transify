<div class="m-3 flex">
    <img style="border-radius: 50%; width: 50px; height: 50px" src="https://via.placeholder.com/150" class="img-thumbnail" alt="{{ auth()->user()->longname }}">
    <span class="fw-bold">{{ auth()->user()->fullname }}</span>
</div>
<div id="list-example" class="list-group">
    <a class="list-group-item list-group-item-action {{ \Request::is('home') ? 'active' : '' }}" href="{{route('home')}}">Dashboard</a>
    <a class="list-group-item list-group-item-action {{ \Request::is('transactions') ? 'active' : '' }}" href="{{route('transactions.index')}}">Transactions</a>

</div>
