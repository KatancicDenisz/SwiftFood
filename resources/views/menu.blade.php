@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="text-center mt-4">
            @foreach ($categories as $category)
            <a href="{{route('menu.category',['id' => $category->id ])}}" class="category_name ml-2 mb-2 badge badge-dark" style="font-weight: 1">{{ $category->name }}</a>
            @endforeach
        </div>
        @if($category_id == null)
            <h1 class="text-center mt-5 lobster m-3" style="font-size: 2.5rem" >Nem létezik ilyen kategória!</h1>
        @elseif($category_id == 'all')
            @foreach ($categories as $category)
                <h1 class="text-center mt-5 lobster m-3" style="font-size: 2.5rem" id="title_{{$category->name }}">{{ $category->name }}</h1>
                <div class="row" id="hide_{{ $category->name }}">
                    @foreach ($category->items as $i)
                        <div class="col-sm-4  col-xs-2">
                            <div>
                                <h3 class="text-center mt-1 item_name">{{ $i->name }}</h3>
                                <div class="card mb-5">
                                    <img class="mx-auto d-block img-fluid mb-4" @if($i->image_url == null) src="{{ Storage::url('images/notfound.png')
                                      }}"@else src="{{ Storage::url('images/' . $i->image_url)
                                      }}" @endif
                                        data-color="lightblue" alt="{{$i->name}}"  style="width: 100%; max-height:183px">
                                    <p class="ml-2 text-center item_data_p">{{ $i->description }}</p>
                                    <hr>
                                    <h4 class="ml-3 item_data">{{ $i->price }} Ft</h4>
                                    <form action="{{ route('add') }}" method="post">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="quantity"
                                                class="col-sm-5 col-form-label ml-4 item_data">Mennyiség</label>
                                            <div class="col-sm-5">
                                                <input type="number" class="form-control" @guest disabled @endguest
                                                    name='quantity' value=1 min=1 id="quantity{{$i->name}}{{ $loop->iteration }}" max=10>
                                                    <input type="hidden" name="item_id" value="{{$i->id}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <div class="d-flex justify-content-center">
                                                    <button type="submit" class="btn btn-primary" @guest disabled
                                                        @endguest>Kosárba
                                                        teszem</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr id="hr_{{$category->name }}">
            @endforeach
        @else
        <h1 class="text-center mt-5 lobster m-3" style="font-size: 2.5rem" id="title_{{$category_id->name }}">{{ $category_id->name }}</h1>
        <div class="row" id="hide_{{ $category_id->name }}">
            @foreach ($category_id->items as $i)
                <div class="col-sm-4  col-xs-2">
                    <div>
                        <h3 class="text-center mt-1 item_name">{{ $i->name }}</h3>
                        <div class="card mb-5">
                            <img class="mx-auto d-block img-fluid mb-4" @if($i->image_url == null) src="{{ Storage::url('images/notfound.png')
                                      }}"@else src="{{ Storage::url('images/' . $i->image_url)
                                      }}" @endif
                                        data-color="lightblue" alt="{{$i->name}}"  style="width: 100%; max-height:183px">
                            <p class="ml-2 text-center item_data_p">{{ $i->description }}</p>
                            <hr>
                            <h4 class="ml-3 item_data">{{ $i->price }} Ft</h4>
                            <form action="{{ route('add') }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label for="quantity"
                                        class="col-sm-5 col-form-label ml-4 item_data">Mennyiség</label>
                                    <div class="col-sm-5">
                                        <input type="number" class="form-control" @guest disabled @endguest
                                            name='quantity' value=1 min=1 id="quantity{{$i->name}}{{ $loop->iteration }}" max=10>
                                            <input type="hidden" name="item_id" value="{{$i->id}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary" @guest disabled
                                                @endguest>Kosárba
                                                teszem</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <hr id="hr_{{$category_id->name }}">
        @endif
    </div>
@endsection


@section('scripts')

    <script type="text/javascript">
        const body = document.querySelector("body");
        window.addEventListener("load", () => {
            body.style.background = "url('/storage/images/salt.jpg') no-repeat center center fixed";
            body.style.backgroundPposition= "center";
            body.style.backgroundSize= "cover";
        })

        const cb = document.querySelectorAll("input[type=checkbox]")
        cb.forEach(function(c) {
            c.addEventListener("change", function() {
                const checkedBoxes = document.querySelectorAll('input[name=checkbox]');
                checkedBoxes.forEach(function(i) {
                    let hideItem = document.getElementById("hide_" + i.id)
                    let hideTitle = document.getElementById("title_" + i.id)
                    let hideHr = document.getElementById("hr_" + i.id)
                    let substringed = hideItem.id.substring(5)
                    let title = hideTitle.id.substring(6)
                    let hr = hideHr.id.substring(3)
                    if (i.checked) {
                        if (i.id === substringed) {
                            hideItem.style.display = "flex";
                        }
                        if (i.id === title) {
                            hideTitle.style.display = "block";
                        }
                        if (i.id === hr) {
                            hideHr.style.display = "block";
                        }
                    } else {
                        if (i.id === substringed) {
                            hideItem.style.display = "none";
                        }
                        if (i.id === title) {
                            hideTitle.style.display = "none";
                        }
                        if (i.id === hr) {
                            hideHr.style.display = "none";
                        }
                    }
                })
            })
        })

    </script>
@endsection
