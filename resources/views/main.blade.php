@extends('layouts.app')
@section('content')
        <div id="foodCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#foodCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#foodCarousel" data-slide-to="1"></li>
          <li data-target="#foodCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="{{ Storage::url('images/hamburger.jpg') }}"  data-color="lightblue" alt="Hamburger">
            <div class="carousel-caption d-none d-md-block">
              <h1 class="lutrisa">Több száz minőségi étel</h1>
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{ Storage::url('images/delivery.jpg') }}" data-color="lightblue" alt="Food delivery">
            <div class="carousel-caption d-none d-md-block">
              <h1 class="lutrisa">Érintésmentes kiszállítás</h1>
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{ Storage::url('images/meat.jpg') }}" data-color="lightblue" alt="Raw meat">
            <div class="carousel-caption d-none d-md-block">
                <h1 class="lutrisa">100%-os natúr adalékmentes ételek</h1>
            </div>
          </div>
        </div>

        <!-- Controls -->
        <a class="carousel-control-prev" href="#foodCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#foodCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>

      </div>
    <br>
    <br>
    <div class="container">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 mt-3">
              <div class="card mx-auto" style="width:10rem;">
                <div class="card-body">
                  <h5 class="card-title text-center lutrisa">Felhasználók</h5>
                  <h2 class="card-text text-center lutrisa">{{$user_count}}</h2>
                </div>
              </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 mt-3">
              <div class="card mx-auto" style="width:10rem;">
                <div class="card-body">
                    <h5 class="card-title text-center lutrisa">Kategóriák</h5>
                    <h2 class="card-text text-center lutrisa">{{$category_count}}</h2>
                </div>
              </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4  col-lg-4 mt-3">
                <div class="card mx-auto" style="width:10rem;">
                  <div class="card-body">
                    <h5 class="card-title text-center lutrisa">Itemek</h5>
                  <h2 class="card-text text-center lutrisa">{{$item_count}}</h2>
                  </div>
                </div>
              </div>
          </div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
    const body = document.querySelector("body");
    body.style.background = "none";
</script>
@endsection
