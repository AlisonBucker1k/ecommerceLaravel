@extends('site.main')
@section('content')
     <!-- My Account Section Start -->
    <div class="section section-margin">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">

                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <!-- My Account Tab Menu Start -->
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <div class="myaccount-tab-menu nav" role="tablist">
                                    <a href="{{route('panel.profile')}}" ><i class="fa fa-dashboard"></i>
                                        Alterar Dados</a>
                                    <a href="{{route('panel.orders')}}" ><i class="fa fa-cart-arrow-down"></i> Minhas Compras</a>
                                    <a href="{{route('panel.addresses')}}" class="active"  class="active"><i class="fa fa-map-marker"></i> Endereços</a>
                                    <a href="{{route('customer.logout')}}"><i class="fa fa-sign-out"></i> Sair</a>
                                </div>
                            </div>
                            <!-- My Account Tab Menu End -->

                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">
                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3 class="title">Seu Endereço</h3>
                                            
                                            @if ($addresses)
                                                @foreach ($addresses as $address)
                                                    <address>
                                                        <p>{{$address->street}}, {{$address->number}} <br>
                                                        {{ $address->district }}, {{ $address->city }} - {{ $address->state }}, {{ $address->postal_code }}</p>
                                                        @if ($address->main)
                                                            <span class="px-2">
                                                                <i class="fas fa-star"></i>
                                                            </span>
                                                        @else
                                                        <a href="{{ route('panel.address.set_main', address.id) }}" class="px-2" data-toggle="tooltip" data-placement="left" title="Tornar principal">
                                                            <i class="fas fa-star"></i>
                                                        </a>
                                                        <a href="{{ route('panel.address.delete', address.id) }}" data-toggle="tooltip" data-placement="left" title="Remover" onclick="return confirm('Deseja realmente remover?')">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                        @endif
                                                    </address>
                                                    <hr>
                                                @endforeach
                                            @else 
                                                <p class="saved-message">Nenhum endereço cadastrado.</p>
                                            @endif

                                            <form action="" method="POST">
                                                @csrf
                                                <fieldset>
                                                    <legend>Novo endereço</legend>
                                                    <p>Preencha os campos se desejar inserir um novo endereço.</p>

                                                    <div class="single-input-item mb-3">
                                                        <label for="current-pwd" class="required mb-1">CEP</label>
                                                        <input type="text" id="cep" placeholder="Seu cep" name="cep" value="{{ old('cep') }}" onblur="findCep(this.value);" />
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <div class="single-input-item mb-3">
                                                                <label for="new-pwd" class="required mb-1">Rua</label>
                                                                <input type="text" id="street" placeholder="Rua" name="street" value="{{ old('street') }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="single-input-item mb-3">
                                                                <label for="confirm-pwd" class="required mb-1">Número</label>
                                                                <input type="number" id="number" placeholder="Número da residencia" name="number" value="{{ old('number') }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item mb-3">
                                                                <label for="new-pwd" class="required mb-1">Cidade</label>
                                                                <input type="text" id="city" placeholder="Cidade" name="city" value="{{ old('city') }}"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item mb-3">
                                                                <label for="confirm-pwd" class="required mb-1">Estado</label>
                                                                <select name="state" id="uf" class="form-control form-control-lg">
                                                                    <option value="">Selecione seu estado</option>
                                                                    <option value="AC" {{(old('state') == "AC")?'selected':''}} >Acre</option>
                                                                    <option value="AL" {{(old('state') == "AL")?'selected':''}} >Alagoas</option>
                                                                    <option value="AP" {{(old('state') == "AP")?'selected':''}} >Amapá</option>
                                                                    <option value="AM" {{(old('state') == "AM")?'selected':''}} >Amazonas</option>
                                                                    <option value="BA" {{(old('state') == "BA")?'selected':''}} >Bahia</option>
                                                                    <option value="CE" {{(old('state') == "CE")?'selected':''}} >Ceará</option>
                                                                    <option value="DF" {{(old('state') == "DF")?'selected':''}} >Distrito Federal</option>
                                                                    <option value="ES" {{(old('state') == "ES")?'selected':''}} >Espírito Santo</option>
                                                                    <option value="GO" {{(old('state') == "GO")?'selected':''}} >Goiás</option>
                                                                    <option value="MA" {{(old('state') == "MA")?'selected':''}} >Maranhão</option>
                                                                    <option value="MT" {{(old('state') == "MT")?'selected':''}} >Mato Grosso</option>
                                                                    <option value="MS" {{(old('state') == "MS")?'selected':''}} >Mato Grosso do Sul</option>
                                                                    <option value="MG" {{(old('state') == "MG")?'selected':''}} >Minas Gerais</option>
                                                                    <option value="PA" {{(old('state') == "PA")?'selected':''}} >Pará</option>
                                                                    <option value="PB" {{(old('state') == "PB")?'selected':''}} >Paraíba</option>
                                                                    <option value="PR" {{(old('state') == "PR")?'selected':''}} >Paraná</option>
                                                                    <option value="PE" {{(old('state') == "PE")?'selected':''}} >Pernambuco</option>
                                                                    <option value="PI" {{(old('state') == "PI")?'selected':''}} >Piauí</option>
                                                                    <option value="RJ" {{(old('state') == "RJ")?'selected':''}} >Rio de Janeiro</option>
                                                                    <option value="RN" {{(old('state') == "RN")?'selected':''}} >Rio Grande do Norte</option>
                                                                    <option value="RS" {{(old('state') == "RS")?'selected':''}} >Rio Grande do Sul</option>
                                                                    <option value="RO" {{(old('state') == "RO")?'selected':''}} >Rondônia</option>
                                                                    <option value="RR" {{(old('state') == "RR")?'selected':''}} >Roraima</option>
                                                                    <option value="SC" {{(old('state') == "SC")?'selected':''}} >Santa Catarina</option>
                                                                    <option value="SP" {{(old('state') == "SP")?'selected':''}} >São Paulo</option>
                                                                    <option value="SE" {{(old('state') == "SE")?'selected':''}} >Sergipe</option>
                                                                    <option value="TO" {{(old('state') == "TO")?'selected':''}} >Tocantins</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-7">
                                                            <div class="single-input-item mb-3">
                                                                <label for="current-pwd" class="required mb-'1'">Bairro</label>
                                                                <input type="text" id="district" placeholder="Bairro" name="district" value="{{ old('district') }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <div class="single-input-item mb-3">
                                                                <label for="current-pwd" class="required mb-1">Complemento</label>
                                                                <input type="text" id="complement" placeholder="Complemento" name="complement" value="{{ old('complement') }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="single-input-item mb-3">
                                                                <label for="current-pwd" class="required mb-1">Referência</label>
                                                                <input type="text" id="reference" placeholder="Ponto de referencia" name="reference" value="{{ old('reference') }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <div class="single-input-item single-item-button">
                                                    <button class="btn btn btn-dark btn-hover-primary rounded-0">Salvar Alterações</button>
                                                </div>
                                            </form>
                                            
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                     <!-- Single Tab Content Start -->
                                     <div class="tab-pane fade" id="dashboard" role="tabpanel">
                                        <div class="myaccount-content">
                                            
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="payment-method" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3 class="title">Payment Method</h3>
                                            <p class="saved-message">You Can't Saved Your Payment Method yet.</p>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3 class="title">Billing Address</h3>
                                            <address>
                                                <p><strong>Alex Aya</strong></p>
                                                <p>1234 Market ##, Suite 900 <br>
                                                Lorem Ipsum, ## 12345</p>
                                                <p>Mobile: (123) 123-456789</p>
                                            </address>
                                            <a href="#" class="btn btn btn-dark btn-hover-primary rounded-0"><i class="fa fa-edit me-2"></i>Edit Address</a>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="account-info" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3 class="title">Account Details</h3>
                                            <div class="account-details-form">
                                                <form action="#">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item mb-3">
                                                                <label for="first-name" class="required mb-1">First Name</label>
                                                                <input type="text" id="first-name" placeholder="First Name" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item mb-3">
                                                                <label for="last-name" class="required mb-1">Last Name</label>
                                                                <input type="text" id="last-name" placeholder="Last Name" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-input-item mb-3">
                                                        <label for="display-name" class="required mb-1">Display Name</label>
                                                        <input type="text" id="display-name" placeholder="Display Name" />
                                                    </div>
                                                    <div class="single-input-item mb-3">
                                                        <label for="email" class="required mb-1">Email Addres</label>
                                                        <input type="email" id="email" placeholder="Email Address" />
                                                    </div>
                                                    <fieldset>
                                                        <legend>Password change</legend>
                                                        <div class="single-input-item mb-3">
                                                            <label for="current-pwd" class="required mb-1">Current Password</label>
                                                            <input type="password" id="current-pwd" placeholder="Current Password" />
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item mb-3">
                                                                    <label for="new-pwd" class="required mb-1">New Password</label>
                                                                    <input type="password" id="new-pwd" placeholder="New Password" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item mb-3">
                                                                    <label for="confirm-pwd" class="required mb-1">Confirm Password</label>
                                                                    <input type="password" id="confirm-pwd" placeholder="Confirm Password" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <div class="single-input-item single-item-button">
                                                        <button class="btn btn btn-dark btn-hover-primary rounded-0">Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> <!-- Single Tab Content End -->
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