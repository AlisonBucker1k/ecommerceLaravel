
@extends('site.main')

@section('content')
<section class="page-header page-header-classic">
    <div class="container">
        <div class="row">
            <div class="col p-static">
                <h1 data-title-border>Minhas Compras</h1>
            </div>
        </div>
    </div>
</section>
<div class="container py-2">
    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <div class="col-12">
                    <table class="table table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center"># Pedido</th>
                                <th scope="col" class="text-center">Data</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-right">Valor</th>
                                <th scope="col" class="text-center">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <th scope="row" class="text-center">#{{ $order->id }}</th>
                                    <td class="text-center">{{ dateSql2Br($order->created_at) }}</td>
                                    <td class="text-center">{{ $order->status_description }}</td>
                                    <td class="text-right">
                                        R$ {{ currencyFloat2Brl($order->value) }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('panel.order.show', $order->id) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="left" title="Detalhes">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Nenhuma compra realizada</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="col-md-12 col-xs-12 col-sm-12">
                        {{-- TODO corrigir paginaçao --}}
                        {{-- {{ orders.appends(app.request.except('page')).links | raw }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
