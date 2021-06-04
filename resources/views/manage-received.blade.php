@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="text-center mt-5">Folyamatban lévő rendelések</h1>
    <div class="row">
        <div class="col-12">
            <div class="list-group">
                @forelse($receivedOrders as $orders)
                    <a href="{{ route('manage.received.order', ['id' => $orders->id]) }}"
                    class="list-group-item list-group-item-action'">Rendelés-{{ $orders->id }}</a>
                @empty
                    <h1 class="text-center mt-5"><b>Jelenleg nincsennek folyamatban lévő rendelések!</b></h1>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
