@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-center mt-5">{{$item->name}} frissítése</h1>
        @if (session()->has('exists'))
            @if (session()->get('exists') == true)
                <div class="alert alert-danger" role="alert">
                    Létezik már ilyen kategória!
                </div>
            @endif
        @endif
        <form method="POST" action="{{route('item.update', ['id' => $item->id]) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="item_name">Item neve</label>
                <input type="text" class="form-control required {{ $errors->has('item_name') ? 'is-invalid' : '' }}"  value="{{ old('item_name') ? old('item_name') : $item->name }}" id="item_name" required name="item_name"  aria-describedby="itemHelp">
                @if ($errors->has('item_name'))
                    <div class="invalid-feedback">
                        <strong>{{$errors->first('item_name')}}</strong>
                    </div>
                 @endif
              </div>
              <div class="form-group">
                <label for="item_price">Item ára</label>
                <input type="number" step="any" required class="form-control  required{{ $errors->has('item_price') ? 'is-invalid' : '' }}" value="{{ old('item_price') ? old('item_price') : $item->price }}" id="item_price" name="item_price"  aria-describedby="itemPrice">
                @if ($errors->has('item_price'))
                    <div class="invalid-feedback">
                        <strong>{{$errors->first('item_price')}}</strong>
                    </div>
                 @endif
              </div>
              <div class="form-group">
                <label for="item_desc">Item leírása</label>
                <textarea class="form-control" id="item_desc" required name="item_desc" rows="3">{{ old('item_desc') ? old('item_desc') : $item->description }}
                </textarea>
                @error('item_desc')
                <div class="text-danger">
                    {{ $errors->first('item_desc') }}
                </div>
            @enderror
              </div>
              <div class="form-group">
                <label for="image">Kép</label>
                    <input name="image" type="file" class="form-control-file"  value="{{ old('image') ? old('image') : $item->image_url }}" id="image">
                    @error('image')
                        <div class="text-danger">
                            {{ $errors->first('image') }}
                        </div>
                    @enderror
            </div>
            <h6>Kategóriák</h6>
            @forelse ($categories as $category)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" value="{{ $category->id }}" id="category{{ $loop->iteration }}" name="categories[]"
                    @if(old('categories') ? in_array($category->id, old('categories')) : in_array($category->id, $category_ids)) checked @endif>
                    <label for="category{{ $loop->iteration }}" class="form-check-label">{{ $category->name }}</label>
                </div>
            @empty
                <p>Nincsenek még kategóriák az adatbázisban</p>
            @endforelse
            @error('categories')
            <div class="text-danger">
                {{ $errors->first('categories') }}
            </div>
             @enderror
            <button type="submit" class="btn btn-primary">Hozzáad</button>
        </form>
    </div>
@endsection
