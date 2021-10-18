
@extends('site.main')
@section('content')
     <!-- My Account Section Start -->
    <div class="section section-margin">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    {{-- <p class="saved-message">You Can't Saved Your Payment Method yet.</p> --}}
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <!-- My Account Tab Menu Start -->
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <div class="myaccount-tab-menu nav" role="tablist">
                                    <a href="{{route('panel.profile')}}" ><i class="fa fa-dashboard"></i>
                                        Alterar Dados</a>
                                    <a href="{{route('panel.orders')}}" class="active"><i class="fa fa-cart-arrow-down"></i> Minhas Compras</a>
                                    <a href="{{route('panel.addresses')}}" ><i class="fa fa-map-marker"></i> Endereços</a>
                                    <a href="{{route('customer.logout')}}"><i class="fa fa-sign-out"></i> Sair</a>
                                </div>
                            </div>
                            <!-- My Account Tab Menu End -->

                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="dashboard">
                                    
                                    <div class="tab-pane fade active show" id="orders" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3 class="title">Minhas Compras</h3>
                                            <div class="myaccount-table table-responsive text-center">
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Cod.</th>
                                                            <th>Data</th>
                                                            <th>Status</th>
                                                            <th>Total</th>
                                                            <th>Ações</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($orders as $order)
                                                        <tr>
                                                            <td># {{$order->id}}</td>
                                                            <td>{{ dateSql2Br($order->created_at) }}</td>
                                                            <td>{{ $order->status_description }}</td>
                                                            <td>{{ currencyFloat2Brl($order->value) }}</td>
                                                            <td><a href="{{ route('panel.order.show', $order->id) }}" class="btn btn btn-dark btn-hover-primary btn-sm rounded-0">Ver detalhes</a></td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div> <!-- My Account Tab Content End -->
                        </div>
                    </div>
                    <!-- My Account Page End -->

                </div>
            </div>

        </div>
    </div>
    <!-- My Account Section End -->
@endsection
