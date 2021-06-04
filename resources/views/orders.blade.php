@extends('layouts.app')

@section('content')
    <div class="container lutrisa">
        <h1 class="text-left mt-5 lobster" style="color:white">Rendelések
        </h1>
        <h3 class="mt-5" style="color:white"><strong>Öszesen:</strong>
            @php
            $totalPrice = 0;
            if($orders != null){
                foreach($orders as $o) {
                    foreach($o->ordereditems as $i) {
                        if($i->item == null) {
                            $totalPrice += 0 * $i->quantity;
                        } else {
                            $totalPrice += $i->item->price * $i->quantity;
                     }
                    }
                }
            }
            @endphp
            {{ $totalPrice }} Ft
        </h3>
        <div class="row">
            <div class="modal" id="myModal" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Sikeres rendelés</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Az ételt hamarosan kiszállítjuk</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <h3 class="mt-5" style="color:white"> <strong>A rendelt ételek:</strong> </h3>
                @if ($orders != null)
                        @foreach ($orders as $o)
                            @foreach ($o->ordereditems as $items)
                                <div class="{{$items->item()->withTrashed()->first()->trashed() ? 'card text-white bg-danger mb-3' : 'card mb-3'}}" style="max-width: 540px;">
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                            <img src="{{ $items->item()->withTrashed()->first()->image_url == null ?
                                            Storage::url('images/notfound.png') :
                                            Storage::url('images/' . $items->item()->withTrashed()->first()->image_url) }}" class="card-img mr-2"
                                                alt="{{  $items->item()->withTrashed()->first()->name}}" style="width: 100%; max-height:133px">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body" style="padding: 0.25rem">
                                                <h5><span class="badge badge-primary badge-pill" style="position: absolute; top: 10px; right: 5px">{{ $items->quantity }}</span></h5>
                                                <h5 class="card-title mt-0 ml-2">{{  $items->item()->withTrashed()->first()->name }} ({{$o->status}})</h5>
                                                <p class="card-text ml-2">{{  $items->item()->withTrashed()->first()->description }}</p>
                                                <p class="card-text ml-2">
                                                 {{  $items->item()->withTrashed()->first()->price }} Ft </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                @else
                    <h5 class="mt-1" style="color:white">Jelenleg nincs rendelés</h5>
                @endif
            </div>
            <div class="col-md-4 col-lg-4 col-sm-12">
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @if (session()->has('ordedSuccess'))
        @if (session()->get('ordedSuccess') == true)
            <script style="text/javascript">
                $(function() {
                    $('#myModal').modal('show');
                });
            </script>
        @endif
    @endif
    <script style="text/javascript">
        const body = document.querySelector("body");
        body.style.background ="url('/storage/images/table.jpg') no-repeat center center fixed";
        body.style.backgroundPposition ="center";
        body.style.backgroundSize =  "cover";
    </script>
@endsection
