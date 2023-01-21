@extends('layouts.master')


@section('title')
    Selamat Datang
@endsection

@section('rute')
    @parent
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $kategori }}</h3>

                        <p>Kategori</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <a href="{{ Route('kategori.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $produk }}<sup style="font-size: 20px"></sup></h3>

                        <p>Produk</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <a href="{{ Route('produk.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $supplier }}</h3>

                        <p>Total Supplier</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-id-badge"></i>
                    </div>
                    <a href="{{ Route('supplier.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $member }}</h3>

                        <p>Total Member</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <a href="{{ Route('member.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->

        <!-- /.row -->
    </div>
    <!--/. container-fluid -->
@endsection
