@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-center mt-5">Rendelések kezelése</h1>

        @if (session()->has('accepted'))
        @if (session()->get('accepted') == true)
            <div class="alert alert-success" role="alert">
                Sikeresen elfogadta a rendelést!
            </div>
        @endif
    @endif

    @if (session()->has('rejected'))
        @if (session()->get('rejected') == true)
            <div class="alert alert-success" role="alert">
                Sikeresen elutasította a rendelést!
            </div>
        @endif
    @endif

        <div class="text-center mt-5">
            <a href="{{route('manage.received')}}" type="button" class="btn btn-primary btn-lg  mr-3">Folyamatban lévő rendelések</a>
            <a href="{{route('manage.processed')}}" type="button" class="btn btn-primary btn-lg  mr-3">Feldolgozott rendelések</a>
        </div>
    </div>
@endsection
