@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
      <h1>  Ola, {{ auth()->user()->name }}</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Inicio</a></li>
    </ul>
</div>

<div class="row">
    <div class="col-md-6 col-lg-3">
      <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
        <div class="info">
          <h4>Users</h4>
          <p><b>5</b></p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="widget-small info coloured-icon"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
        <div class="info">
          <h4>Likes</h4>
          <p><b>25</b></p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
        <div class="info">
          <h4>Uploades</h4>
          <p><b>10</b></p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
        <div class="info">
          <h4>Stars</h4>
          <p><b>500</b></p>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
            <div class="row">
                <div class="col-md-6 col-lg-3">
                  <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                      <button>NOVO</button>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-3">
                  <div class="widget-small info coloured-icon"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
                    <div class="info">
                      <button>Minhas postagens</button>
                    </div>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection
