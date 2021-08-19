@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Por favor Verifique seu email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Um novo link de verificação foi enviado para o seu email') }}
                        </div>
                    @endif

                    {{ __('Antes de continuar, por favor veriifque o seu email para confirmar através do link de confirmação.') }}
                    {{ __('Caso você não tenha recebido o email') }}, <a href="{{ route('verification.resend') }}">{{ __('Click aqui para reenviar o link de confirmação') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
