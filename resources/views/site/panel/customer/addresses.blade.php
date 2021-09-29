@extends('site.main')

@section('content')
<section class="page-header page-header-classic">
    <div class="container">
        <div class="row">
            <div class="col p-static">
                <h1 data-title-border>Endereços</h1>
            </div>
        </div>
    </div>
</section>
<div class="container py-2">
    <div class="row">
        <div class="col-lg-9">
            {{-- <div class="row mb-2">
                <div class="col-12">
                    <button style="margin-top: 7px;" aria-controls="collapseExample" aria-expanded="false" class="btn btn-sm btn-primary btn-modern float-right" data-target="#add-address" data-toggle="collapse" type="button">
                        <i class="fa fa-plus"></i> Endereço
                    </button>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-lg-12 table-responsive-lg">
                    <table class="table border mb-0">
                        <tbody>
                            @forelse ($addresses as $address)
                                <tr>
                                    <td>{{ $address->street }}, {{ $address->number }} - {{ $address->district }}, {{ $address->city }} - {{ $address->state }}, {{ $address->postal_code }}</td>
                                    <td class="text-right">
                                        @if ($address->main)
                                            <span class="px-2">
                                                <i class="fa fa-star"></i>
                                            </span>
                                        @else
                                            <a href="{{ route('panel.address.set_main', $address->id) }}" class="px-2" data-toggle="tooltip" data-placement="left" title="Tornar principal">
                                                <i class="fa fa-star-o"></i>
                                            </a>
                                        @endif

                                        <a href="{{ route('panel.address.delete', $address->id) }}" data-toggle="tooltip" data-placement="left" title="Remover" onclick="return confirm('Deseja realmente remover?')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center">Nenhum endereço cadastrado</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <br>
            <div class="" id="add-address">
                <div class="overflow-hidden mb-1">
                    <h2 class="font-weight-normal text-5 mb-4">
                        <strong class="font-weight-extra-bold">Novo </strong> Endereço
                    </h2>
                </div>
                <form method="post">
                    @csrf
                    <div class="form-group row">
                        <div class="col-lg-4">
                            <input name="cep" id="cep" class="form-control" type="text" value="{{ old('cep') }}" placeholder="CEP" onblur="findCep(this.value);">
                        </div>
                        <div class="col-lg-8">
                            <input name="street" id="street" class="form-control" type="text" value="{{ old('street') }}" placeholder="Rua...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <input name="complement" class="form-control" type="text" value="{{ old('complement') }}" placeholder="Complemento, Ex: Apto 2014 - Torre Sul">
                        </div>
                        <div class="col-lg-6">
                            <input name="reference" class="form-control" type="text" value="{{ old('reference') }}" placeholder="Referência, Ex: Próximo ao colégio Estadual">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <input name="number" class="form-control" type="text" value="{{ old('number') }}" placeholder="Número">
                        </div>
                        <div class="col-lg-3">
                            <input name="city" id="city" class="form-control" type="text" value="{{ old('city') }}" placeholder="Cidade">
                        </div>
                        <div class="col-lg-3">
                            <input name="state" id="uf" class="form-control" type="text" value="{{ old('state') }}" placeholder="Estado">
                        </div>
                        <div class="col-lg-3">
                            <input name="district" id="district" class="form-control" type="text" value="{{ old('district') }}" placeholder="Bairro">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-group col-lg-8"></div>
                        <div class="form-group col-lg-4">
                            <input type="submit" value="Cadastrar" class="btn btn-primary btn-modern float-right" data-loading-text="Loading...">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script type="text/javascript" src="/general/components/jquery-mask-plugin/src/jquery.mask.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#cep').mask('00000-000');
        });

        function clearForm() {
            document.getElementById('district').value=("");
            document.getElementById('city').value=("");
            document.getElementById('street').value=("");
            document.getElementById('uf').value=("");
        }

        function callback(data) {
            if (!("erro" in data)) {
                document.getElementById('district').value=(data.bairro);
                document.getElementById('city').value=(data.localidade);
                document.getElementById('street').value=(data.logradouro);
                document.getElementById('uf').value=(data.uf);
            } else {
                clearForm();
                toastr.error("CEP não encontrado.");
            }
        }

        function findCep(valor) {
            var cep = valor.replace(/\D/g, '');
            if (cep != "") {
                var cepValidate = /^[0-9]{8}$/;

                if (cepValidate.test(cep)) {
                    document.getElementById('district').value="...";
                    document.getElementById('city').value="...";
                    document.getElementById('street').value="...";
                    document.getElementById('uf').value="...";

                    var script = document.createElement('script');
                    script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=callback';
                    document.body.appendChild(script);

                } else {
                    clearForm();
                    toastr.error('Formato de CEP inválido.');
                }
            } else {
                clearForm();
            }
        }
    </script>
@endpush