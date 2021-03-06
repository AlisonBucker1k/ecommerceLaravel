
@extends('site.main')

@section('content')
<section class="page-header page-header-classic">
    <div class="container">
        <div class="row">
            <div class="col p-static">
                <h1 data-title-border>Pedido #{{ $order->id }}</h1>
            </div>
            <div class="text-right col">
                <span class="badge badge-pill badge-dark" style="font-size: 15px;">
                    {{ $order->status_description }}
                </span>
            </div>
        </div>
    </div>
</section>
<div class="container py-2">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="featured-boxes">
                        <div class="row mb-5">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group row mb-2">
                                            <h5>Status do Pedido</h5>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <div class="col">{{ $order->status_description }}</div>
                                        </div>
                                        <hr>
                                        <div class="form-group row mb-2">
                                            <h5>Status do Pagamento</h5>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <div class="col">{{ $order->payment_status_description }}</div>
                                        </div>

                                        @if(!empty($pagarMeOrder))
                                            @if ($pagarMeOrder->isPaymentTypeBill())
                                                <a href="{{ $pagarMeOrder->getOrder()->boleto_url }}" class="btn btn-sm btn-success mb-2" target="_blank">Pagar Boleto</a>

{{--                                                @if ($pagarMeOrder->canCancelBill())--}}
{{--                                                    <a href="{{ route('panel.order.cancel', $order->id) }}" onclick="return confirm('Deseja realmente cancelar o pedido?');" class="btn btn-sm btn-danger mb-2">Cancelar Pedido</a>--}}
{{--                                                @endif--}}
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group row mb-0">
                                            <h5>Detalhes do Pedido</h5>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <label class="font-weight-bold">Valor:</label>
                                            <div class="col">{{ $order->value_formated }}</div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <label class="font-weight-bold">Data:</label>
                                            <div class="col">{{ dateSql2Br($order->created_at) }}</div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <label class="font-weight-bold">Frete:</label>
                                            <div class="col">
                                                @if ($order->shipping_value > 0)
                                                    {{ $order->shipping_value_formated }}
                                                @else
                                                    <strong>Gr??tis</strong>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <label class="font-weight-bold">Envio:</label>
                                            <div class="col">Em {{ $order->shipping_deadline }} dias ??teis ({{ $order->shipping_description }})</div>
                                        </div>

                                        @if ($shippingCode != '')
                                            <div class="form-group row mb-0">
                                                <label class="font-weight-bold">C??digo de Rastreio:</label>
                                                <div class="col">{{ $shippingCode }}</div>
                                            </div>
                                        @endif

                                        <div class="form-group row mb-0 mt-3">
                                            <h5>Produtos</h5>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <table class="shop_table cart table table-bordered table-hover table-responsive-sm">
                                                <thead>
                                                    <tr>
                                                        <th class="product-name" colspan="2">Produto</th>
                                                        <th class="product-price text-right">Valor</th>
                                                        <th class="product-quantity text-center">Qtd</th>
                                                        <th class="product-subtotal text-right">Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($order->products as $orderProduct)
                                                        <tr class="cart_table_item">
                                                            <td class="product-thumbnail" width="100">
                                                                <img alt="{{ $orderProduct->name }}" class="img-fluid" src="{{ getFullFtpUrl($orderProduct->image) }}">
                                                            </td>
                                                            <td class="product-name">
                                                                <strong>{{ $orderProduct->name }}</strong>
                                                                <br/>

                                                                @foreach ($orderProduct->items as $item)
                                                                    {{ $item->grid_description }}: {{ $item->grid_variation_description }}<br/>
                                                                @endforeach
                                                            </td>
                                                            <td class="product-price text-right">
                                                                <span class="amount">{{ $orderProduct->final_value_formated }}</span>
                                                                @if ($orderProduct->discount_percent > 0)
                                                                    <br/>
                                                                    <del>
                                                                        <small>
                                                                            <span class="amount">{{ $orderProduct->value_formated }}</span>
                                                                        </small>
                                                                    </del>
                                                                @endif
                                                            </td>
                                                            <td class="product-quantity text-center">
                                                                {{ $orderProduct->quantity }}
                                                            </td>
                                                            <td class="product-subtotal text-right">
                                                                <span class="amount">{{ $orderProduct->subtotal_value_formated }}</span>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    <tr>
                                                        <td colspan="4" class="text-right font-weight-bold">Subtotal</td>
                                                        <td class="text-right font-weight-bold">{{ $order->products_total_value_formated }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" class="text-right font-weight-bold">Frete</td>
                                                        <td class="text-right font-weight-bold">
                                                            @if ($order->shipping_value > 0)
                                                                + {{ $order->shipping_value_formated }}
                                                            @else
                                                                Gr??tis
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" class="text-right font-weight-bold">Total</td>
                                                        <td class="text-right font-weight-bold">{{ $order->value_formated }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        {{-- TODO corrigir cancelamento pelo PagarMe --}}
{{--                                        @if ($order->status == $pendingStatus)--}}
{{--                                            <a href="{{ route('panel.order.cancel',  $order->id) }}" onclick="return confirm('Deseja realmente cancelar o pedido?');" class="btn btn-default btn-block">Cancelar Pedido</a>--}}
{{--                                        @endif--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (!empty($histories))
                <div class="overflow-hidden mb-1">
                    <h2 class="font-weight-normal text-7 mb-4 mt-4">Atualiza????es</h2>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="featured-boxes">
                            <div class="row">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table table-hover table-responsive-sm">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Descri????o</th>
                                                        <th scope="col" class="text-center">Data</th>
                                                        <th scope="col" class="text-center">Status</th>
                                                        <th scope="col" class="text-center">Arquivo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($histories as $history)
                                                        <tr>
                                                            <td>{{ $history->description }}</td>
                                                            <td class="text-center">{{ dateSql2Br($history->created_at) }}</td>
                                                            <td class="text-center">
                                                                {{ $history->status_description }}
                                                                @if ($history->status == $orderHistorySentStatus && !empty($history->code))
                                                                    <br>
                                                                    <small>C??digo: {{ $history->code }}</small>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                @if (!empty($history->file))
                                                                    <a href="{{ getFullFtpUrl($history->file) }}" class="btn btn-sm btn-success" target="_blank" data-toggle="tooltip" data-placement="left" title="Baixar Arquivo">
                                                                        <i class="pe-7s-cloud-download"></i>
                                                                    </a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4" class="text-center">Nenhuma atualiza????o dispon??vel</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
