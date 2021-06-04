@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-center mt-5 mb-5">Itemek kezelése</h1>
        @if (session()->has('added'))
            @if (session()->get('added') == true)
                <div class="alert alert-success" role="alert">
                    Sikeresen hozzáadtad az új itemet!
                </div>
            @endif
        @endif
        @if (session()->has('item_restored'))
            @if (session()->get('item_restored') == true)
                <div class="alert alert-success" role="alert">
                    Sikeresen Vissza állítottad az itemet!
                </div>
            @endif
        @endif
        @if (session()->has('updated'))
            @if (session()->get('updated') == true)
                <div class="alert alert-success" role="alert">
                    Sikeresen frissítetted az itemet!
                </div>
            @else
                <div class="alert alert-danger mb-3" role="alert">
                    <div class="alert alert-success" role="alert">
                        Nincs ilyen item!
                    </div>
                </div>
            @endif
        @endif
        @if (session()->has('item_deleted'))
            <div class="alert alert-success" role="alert">
                Sikeresen törölted ezt az itemet: {{ session()->get('item_deleted') }}
            </div>
        @endif
        @if (session()->has('exists'))
            @if(session()->get('exists') == false)
            <div class="alert alert-danger" role="alert">
                Nincs ilyen item!
            </div>
            @endif
        @endif
        <div class="row">
            <div class="col-sm-6">
                <div class="list-group">
                    @foreach ($items as $item)
                        <div class="d-flex align-items-center">
                            <a href="{{ route('item.edit', ['id' => $item->id]) }}"
                                class="{{$item->trashed() ? 'list-group-item list-group-item-action disabled' : 'list-group-item list-group-item-action' }}">{{ $item->name }}</a>
                            @if(!$item->trashed())
                                <form action="{{ route('item.delete', ['item_id' => $item->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-dark btn-sm ml-3">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-trash-fill"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                                </svg></button>
                                </form>
                            @else
                            <form action="{{ route('item.restore', ['id' => $item->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-dark btn-sm ml-3">Vissza állít
                                </button>
                            </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center">Item hozzáadása</h5>
                        <a href="{{ route('item.new') }}" type="button"
                            class="btn mt-auto btn-primary text-center btn-lg  mr-3">Új item
                            hozzáadása</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
