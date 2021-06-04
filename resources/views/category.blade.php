@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-center mt-5 mb-5">Kategóriák kezelése</h1>
        @if (session()->has('added'))
            @if (session()->get('added') == true)
                <div class="alert alert-success" role="alert">
                    Sikeresen hozzáadtad az új kategóriát!
                </div>
            @endif
        @endif
        @if (session()->has('updated'))
            @if (session()->get('updated') == true)
                <div class="alert alert-success" role="alert">
                    Sikeresen frissítetted a kategóriát!
                </div>
            @else
                <div class="alert alert-danger mb-3" role="alert">
                    <div class="alert alert-success" role="alert">
                        Nincs ilyen kategória!
                    </div>
                </div>
            @endif
        @endif
        @if (session()->has('category_deleted'))
            <div class="alert alert-success" role="alert">
                Sikeresen törölted ezt a kategóriát: {{ session()->get('category_deleted') }}
            </div>
        @endif
        @if (session()->has('exists'))
            @if(session()->get('exists') == false)
            <div class="alert alert-danger" role="alert">
                Nincs ilyen kategória!
            </div>
            @endif
        @endif
        <div class="row">
            <div class="col-sm-6">
                <div class="list-group">
                    @foreach ($categories as $cat)
                        <div class="d-flex align-items-center">
                            <a href="{{ route('category.edit', ['id' => $cat->id]) }}"
                                class="list-group-item list-group-item-action">{{ $cat->name }}</a>
                            <form action="{{ route('category.delete', ['cat_id' => $cat->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-dark btn-sm ml-3">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-trash-fill"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                                </svg></button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center">Kategória hozzáadása</h5>
                        <a href="{{ route('category.new') }}" type="button"
                            class="btn mt-auto btn-primary text-center btn-lg  mr-3">Új Kategória
                            hozzáadása</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
