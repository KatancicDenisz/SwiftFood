@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-center mt-5">Új kategória hozzáadása</h1>
        @if (session()->has('exists'))
            @if (session()->get('exists') == true)
                <div class="alert alert-danger" role="alert">
                    Létezik már ilyen kategória!
                </div>
            @endif
        @endif
        <form method="POST" action="{{route('store')}}">
            @csrf
            <div class="form-group">
                <label for="category_name">Kategória neve</label>
                <input type="text" class="form-control  {{ $errors->has('category_name') ? 'is-invalid' : '' }}"name="category_name" required aria-describedby="emailHelp">
                @if ($errors->has('category_name'))
                    <div class="invalid-feedback">
                        <strong>{{$errors->first('category_name')}}</strong>
                    </div>
                 @endif
            </div>
            <button type="submit" class="btn btn-primary">Hozzáad</button>
        </form>
    </div>
@endsection
