@extends('layouts.app')
@section('content')
    <div class="container">
        @if ($order == null)
            <h1 class="text-center mt-5">Nem létező rendelés!</h1>
        @else
         <h1 class="text-center mt-5 mb-5">Rendelés - {{ $order->id }} adatai</h1>
         @if($order->status == 'ACCEPTED' || $order->status == 'REJECTED')
         <div class="alert alert-info" role="alert">
            A rendelés már fel lett dolgozva!
          </div>
        @endif
            <div class="row">
                <div class="col-6">
                    <h3>Megrendelő:<b> {{ $order->user->name }}</b> </h3>
                    <h3>Email-cím: <b>{{ $order->user->email }}</b></h3>
                    <h3>Rendelés időpontja: <b>{{ $order->received_on }}</b></h3>
                    <h3>Szállítási cím: <b>{{ $order->address }}</b></h3>
                    <h3>Megjegyzések:<b>{{ $order->comment ? $order->comment : 'Nincs megjegyzés' }}</b></h3>
                </div>
                <div class="col-6">
                    <h3 class="text-center mb-3">Rendelések</h3>
                    <ul class="list-group">
                        @forelse($order->ordereditems as $items)
                        @if($items->item != null)
                            <li class="list-group-item list-group-item-action">{{ $items->quantity }} db {{ $items->item->name }}</li>
                        @endif
                        @empty
                            <h1 class="text-center mt-5"><b>Jelenleg nincsennek folyamatban lévő rendelések!</b></h1>
                         @endforelse
                     </ul>
                </div>
             </div>
             @if($order->status != 'ACCEPTED' && $order->status != 'REJECTED')
                <div class="row d-flex justify-content-center mt-5">
                    <form method="POST" action="{{ route('accept', ['orderId' => $order->id]) }}">
                        @csrf
                            <button type="submit" class="btn btn-lg btn-primary mr-5">Elfogad</button>
                    </form>
                    <form method="POST" action="{{ route('reject', ['orderId' => $order->id]) }}">
                        @csrf
                        <button type="submit" class="btn btn-lg btn-primary">Elutasít</button>
                </form>
                </div>
            @endif
            <hr>
         @endif
    </div>
@endsection
