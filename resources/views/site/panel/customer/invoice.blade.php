
@extends('site.main')

@section('content')
<section class="page-header page-header-classic">
    <div class="container">
        <div class="row">
            <div class="col">
                <ul class="breadcrumb">
                    <li><a href="#">Inicial</a></li>
                    <li><a href="{{ route('panel.orders') }}">Pedidos</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col p-static">
                <h1 data-title-border>Minha Fatura</h1>
            </div>
        </div>
    </div>
</section>

<div class="container py-2">

    <div class="row">
        <div class="col-lg-9">

            <div class="overflow-hidden mb-1">
                <h2 class="font-weight-normal text-7 mb-4"><strong class="font-weight-extra-bold">Fatura #{{ $invoice->id }}</h2>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="bill-to">
                        <p class="h5 mb-1 text-dark font-weight-semibold">Cliente</p>
                        <div>
                            {{ $invoice->customer->profile->name }} {{ $invoice->customer->profile->last_name }}
                            <br/>
                            CPF: {{ $invoice->customer->profile->cpf }}
                            <br/>
                            Telefone: {{ $invoice->customer->profile->phone }}
                            <br/>
                            Celular: {{ $invoice->customer->profile->cellphone }}
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="bill-data text-right">
                        <p class="mb-0">
                            <span class="text-dark">Data de Criação:</span>
                            <span class="ml-1">{{ dateSql2Br($invoice->created_at) }}</span>
                        </p>
                        <p class="mb-0">
                            <span class="text-dark">Data de Vencimento:</span>
                            <span class="ml-1">{{ dateSql2Br($invoice->due_at) }}</span>
                        </p>
                    </div>
                </div>
                <table class="table table-responsive-md invoice-items">
                    <thead>
                    <tr class="text-dark">
                        <th class="font-weight-semibold">Tipo</th>
                        <th class="font-weight-semibold">Descrição</th>
                        <th class="font-weight-semibold text-right">Valor</th>
                        <th class="font-weight-semibold text-center">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $invoice->type_description }}</td>
                            <td>{{ $invoice->description }}</td>
                            <td class="text-right">R$ {{ currencyFloat2Brl($invoice->value) }}</td>
                            <td class="text-center">
                                {{ $invoice->status_description }}
                                <br>
                                <a href="#" class="btn btn-xs btn-primary">Pagar Fatura</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
