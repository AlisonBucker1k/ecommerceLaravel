@extends('site.main')

@section('content')
    <div class="section section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="myaccount-page-wrapper">
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <div class="myaccount-tab-menu nav" role="tablist">
                                    <a href="{{route('panel.profile')}}">
                                        <i class="fa fa-dashboard"></i> Alterar Dados
                                    </a>
                                    <a href="{{route('panel.orders')}}" ><i class="fa fa-cart-arrow-down"></i> Minhas Compras</a>
                                    <a href="{{route('panel.addresses')}}" class="active"  class="active"><i class="fa fa-map-marker"></i> Endereços</a>
                                    <a href="{{route('customer.logout')}}"><i class="fa fa-sign-out"></i> Sair</a>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">
                                    <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3 class="title">Seus Endereços</h3>

                                            @if (!empty($addresses))
                                                @foreach ($addresses as $address)
                                                    <address>
                                                        <p>{{$address->street}}, {{$address->number}} <br>
                                                        {{ $address->district }}, {{ $address->city }} - {{ $address->state }}, {{ $address->postal_code }}</p>
                                                        
                                                        @if ($address->main)
                                                            <span class="px-2">
                                                                <i class="fa fa-star"></i>
                                                            </span>
                                                        @else

                                                        <a href="{{ route('panel.address.set_main', $address->id) }}" class="px-2" data-toggle="tooltip" data-placement="left" title="Tornar principal">
                                                            <i class="fa fa-star"></i>
                                                        </a>
                                                        <a href="{{ route('panel.address.delete', $address->id) }}" data-toggle="tooltip" data-placement="left" title="Remover" onclick="return confirm('Deseja realmente remover?')">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                        @endif
                                                    </address>
                                                    <hr>
                                                @endforeach
                                            @else 
                                                <p class="saved-message">Nenhum endereço cadastrado.</p>
                                            @endif

                                            <a href="#" class="show-address-form btn btn-sm btn-primary" data-toggle="tooltip" data-placement="left" title="Novo Endereço">
                                                <i class="fa fa-plus"></i> Novo Endereço
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5 d-none" id="address-form">
                <div class="col-lg-12">
                    <div class="myaccount-page-wrapper">
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">
                                    <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                        <div class="myaccount-content">
                                            @include('site.elements.address_form', ['address' => null])
                                        </div>
                                    </div>
                                     <div class="tab-pane fade" id="dashboard" role="tabpanel">
                                        <div class="myaccount-content">
                                            
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="payment-method" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3 class="title">Payment Method</h3>
                                            <p class="saved-message">You Can't Saved Your Payment Method yet.</p>
                                        </div>
                                    </div>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $('.show-address-form').click((event) => {
            event.preventDefault();
            $('#address-form').toggleClass('d-none');
        });
    </script>
@endpush