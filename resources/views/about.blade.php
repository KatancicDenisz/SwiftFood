@extends('layouts.app')

@section('content')
    <div class="container">
        <img class="d-block ml-auto mr-auto mb-3 swiftfood-img" alt="swiftfood logo" src="{{ Storage::url('images/logo-transp.png') }}">
        <h1 class="text-center lobster swiftfood-h1">Az alkalmazást készítette: <br> Katancsity Denisz (F2C52K)<h1>
        <h1 class="text-center lobster swiftfood-h1">E-mail: katancic.denisz@gmail.com<h1>
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
