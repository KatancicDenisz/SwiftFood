@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-center mt-5">Admin felület</h1>
        <div class="text-center mt-5">
            <a href="{{route('category')}}" type="button" class="btn btn-primary btn-lg  mr-3">Kategóriak kezelése</a>
            <a href="{{route('item')}}" type="button" class="btn btn-primary btn-lg  mr-3">Itemek kezelése</a>
            <a href="{{route('manage')}}" type="button" class="btn btn-primary btn-lg  mr-3">Rendelések kezelése</a>
        </div>
    </div>
@endsection
