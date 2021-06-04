@extends('layouts.app')

@section('content')
    <div class="container lutrisa">
        @if ($errors->any())
            <div class="alert alert-danger mt-4">
                <ul style="list-style-type:none">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h1 class="text-center mt-5 lobster">Kosár
        </h1>
        <div class="row">
            <div class="col-md-4 col-lg-4 col-sm-12">
                <h3 class="mt-5"><strong>Öszesen:</strong>
                    @php
                    $totalPrice = 0;
                    if($orders != null){
                    foreach($orders->ordereditems as $i) {
                    $totalPrice += $i->item->price * $i->quantity;
                    }
                    }
                    @endphp
                    {{ $totalPrice }} Ft
                </h3>
                <h5>A rendelés állapota:
                @if($orders != null)
                    {{ $orders->status }}
                @else
                    -
                @endif
                </h5>
            </div>
            <div class="col-md-8 col-lg-8 col-sm-12">
                <h3 class="mt-5"><strong>A rendelt ételek: </strong></h3>
                @if ($orders != null)
                    @if (count($orders->ordereditems) == 0)
                        <h5 class="mt-1">Jelenleg a kosár tartalma üres</h5>
                    @else
                        <ul class="list-group">
                            @if ($orders != null)
                                @foreach ($orders->ordereditems as $items)
                                    <li class="list-group-item d-flex align-items-center">
                                        <span class="badge badge-primary badge-pill mr-4">{{ $items->quantity }}</span>
                                        <span class="align-middle">{{ $items->item->name }} - {{ $items->item->price }}
                                            Ft</span>
                                        <form action="{{ route('remove', ['itemId' => $items->id]) }}" method="post"
                                            class="d-flex mr-auto">
                                            @csrf
                                            <input type="hidden" name="itemId" value="{{ $items->id }}">
                                            <div class="ml-auto">
                                                <button type="submit" class="btn btn-dark btn-sm"
                                                    style="position:absolute; right:10px; top:10px">
                                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16"
                                                        class="bi bi-trash-fill" fill="currentColor"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                                                    </svg></button>
                                            </div>
                                        </form>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    @endif
                @else
                    <h5 class="mt-1">Jelenleg a kosár tartalma üres</h5>
                @endif
            </div>
        </div>
        <div class="jumbotron mt-4" style="padding:2rem">
            <h1 class="text-center lobster">Rendelés leadása</h1>
            @if (session()->has('emptyCart'))
                @if (session()->get('emptyCart') == true)
                    <div class="alert alert-danger mb-3" role="alert">
                        Üres a kosár!
                    </div>
                @endif
            @else
                @if ($errors->orderErrors->any())
                    <div class="alert alert-danger mt-4">
                        <ul style="list-style-type:none" class="mb-0">
                            @foreach ($errors->orderErrors->all() as $error)
                                <li class="mb-0">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endif
            <form action="{{ route('send') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="address">Lakcím</label>
                    <input type="text" class="form-control {{ $errors->orderErrors->has('address') ? 'is-invalid' : '' }}"
                        id="address" name="address" placeholder="">
                    @if ($errors->orderErrors->has('address'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->orderErrors->first('address') }}</strong>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="comments">Egyéb megjegyzés</label>
                    <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
                </div>

                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-2 pt-0">Fizetési mód</legend>
                        <div class="col-sm-10">
                            <div class="custom-control custom-radio">
                                <input
                                    class="custom-control-input {{ $errors->orderErrors->has('payment_method') ? 'is-invalid' : '' }}"
                                    type="radio" name="payment_method" id="cash" value="CASH" checked>
                                <label class="custom-control-label" for="cash">
                                    Készpénz
                                </label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input
                                    class="custom-control-input {{ $errors->orderErrors->has('payment_method') ? 'is-invalid' : '' }}"
                                    type="radio" name="payment_method" id="card" value="CARD">
                                <label class="custom-control-label" for="card">
                                    Bankkártya
                                </label>
                                <br>
                                @if ($errors->orderErrors->has('payment_method'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->orderErrors->first('payment_method') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Megrendelem</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
    const body = document.querySelector("body");
    body.style.background ="url('../images/salt.jpg') no-repeat center center fixed";
    body.style.backgroundPposition ="center";
    body.style.backgroundSize =  "cover";
</script>
@endsection


