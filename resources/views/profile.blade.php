@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <div class="parent">
                <div class="text-center prfile">
                    @if(Auth::check())
                        <h1 class="mt-4 lobster"><strong>Bejelentkezett felhasználó adatai</strong></h1>
                        <br>
                        <br>
                        <h2 class="lutrisa prfile-h2"><strong>Név:</strong> {{Auth::user()->name}}</h2>
                        <h2 class="lutrisa prfile-h2"><strong>E-mail: </strong> {{Auth::user()->email}}</h2>
                        <h2 class="lutrisa prfile-h2"><strong>Szerepkör: </strong> {{Auth::user()->is_admin ? 'Admin' : 'Felhasználó'}}</h2>
                    @else
                        <h1 class="mt-4 lobster"><strong>Üdvözlöm vendég, Jelentkezz be!</strong></h1>
                        <img class="d-block w-100" src="{{ Storage::url('images/dog.jpg') }}"  data-color="lightblue" alt="dog">
                    @endif

                </div>
            </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
<script type="text/javascript">
    const body = document.querySelector("body");
    body.style.background ="url('/storage/images/bg-white.jpg') no-repeat center center fixed";
    body.style.backgroundPposition ="center";
    body.style.backgroundSize =  "cover";
</script>
@endsection
