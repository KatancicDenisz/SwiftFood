@extends('layouts.app')
@section('content')
    <div class="container">
            <h1 class="text-center mt-5">{{$category->name}} frissítése</h1><hr>
                <div class="row">
                    <div class="col-12">
                    <form method="POST" action="{{ route('category.update', ['id' => $category->id]) }}">
                        @csrf
                        <div class="form-group">
                            <label for="category_name">Kategória neve</label>
                            <input type="text" class="form-control  {{ $errors->has('category_name') ? 'is-invalid' : '' }}"
                                name="category_name"
                                value="{{ old('category_name') ? old('category_name') : $category->name }}" required
                                aria-describedby="emailHelp">
                            @if ($errors->has('category_name'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('category_name') }}</strong>
                                </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Frissítés</button>
                    </form>
            </div>
        </div>
    </div>
@endsection
