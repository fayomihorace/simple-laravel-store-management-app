@extends('layouts.app')
@section('content')

<section class="content-header">
    <h1>
        Dashboard
        <small>GestStock</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<section class="content">

    @if(Session::has('message'))
    <div class="row">'
        <div class="col-xs-12">
            <div class="alert @if(Session::get('messageType') == 1) alert-success @else alert-danger @endif">
                {{ Session::get('message') }}
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$nb_produits}}</h3>
                    <p>Produits</p>
                </div>
                <div class="icon">
                    <i class="fa fa-briefcase"></i>
                </div>
                <a href="{{ url('/admin/produit') }}" class="small-box-footer">Plus d'info <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{$nb_operations}}</h3>
                    <p>Transactions</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <a href="{{ url('/admin/operation') }}" class="small-box-footer">Plus d'info <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{$nb_magazins}}</h3>
                    <p>Magazins</p>
                </div>
                <div class="icon">
                    <i class="fa fa-truck"></i>
                </div>
                <a href="{{ url('/admin/magazin') }}" class="small-box-footer">Plus d'info <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{$nb_membres}}</h3>
                    <p>Membres</p>
                </div>
                <div class="icon">
                    <i class="fa fa-group"></i>
                </div>
                <a href="{{ url('/admin/membre') }}" class="small-box-footer">Plus d'info <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Produits & stocks </h3>
                </div>
                <div class="box-body">
                  <canvas id="myChart" width="400" height="100"></canvas>
                </div>
            </div>
    </div>
</section>
<script src="/js/Chart.min.js"></script>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var labels_ = [@foreach ($produits as $produit)'{{ $produit->nom }}',@endforeach]
var levels_ = [@foreach ($produits as $produit)'{{ $produit->stock }}',@endforeach]
var limit = 2;
var colors = [@for ($i = 0; $i < $limit ; $i++)@foreach ($products_colors as $c)'{{ $c }}',@endforeach @endfor]
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels_ ,
        datasets: [{
            label: 'Stock',
            data: levels_,
            backgroundColor: colors,
            borderColor: colors,
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

@endsection
