<div class="create-address contact-form-wrapper">
    <form id="address-form" method="post">
        <input type="hidden" name="address_id" value="{{ $address->id ?? '' }}">
        <div class="form-group row">
            <div class="col-lg-4">
                <label>CEP</label>
                <input name="cep" id="cep" class="cep form-control" type="text" value="{{ old('cep', maskCep($address->postal_code ?? '')) }}" onblur="findCep(this.value);" required="required">
            </div>
            <div class="col-lg-8">
                <label>Endereço</label>
                <input name="street" id="street" class="form-control" type="text" value="{{ old('street', $address->street ?? '') }}" placeholder="" required="required">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-6">
                <label>Complemento</label>
                <input name="complement" class="form-control" type="text" value="{{ old('complement', $address->complement ?? '') }}" placeholder="">
            </div>
            <div class="col-lg-6">
                <label>Referência</label>
                <input name="reference" class="form-control" type="text" value="{{ old('reference', $address->reference ?? '') }}" placeholder="">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-3">
                <label>Número</label>
                <input name="number" class="form-control" type="text" value="{{ old('number', $address->number ?? '') }}">
            </div>
            <div class="col-lg-3">
                <label>Cidade</label>
                <input name="city" id="city" class="form-control" type="text" value="{{ old('city', $address->city ?? '') }}" required="required">
            </div>
            <div class="col-lg-3">
                <label>Estado</label>
                <input name="state" id="uf" class="form-control" type="text" value="{{ old('state', $address->state ?? '') }}" required="required">
            </div>
            <div class="col-lg-3">
                <label>Bairro</label>
                <input name="district" id="district" class="form-control" type="text" value="{{ old('district', $address->district ?? '') }}" required="required">
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <button type="submit" id="btn-add-address" name="submit" class="btn btn-dark btn-hover-primary rounded-0">Salvar</button>
            </div>
        </div>
    </form>
</div>

@push('js')
    <script>
        var addressForm = document.getElementById('address-form');
        addressForm.addEventListener('submit', async event => {
            event.preventDefault();

            var btn = $('#btn-add-address');
            btn
                .attr({'disabled': 'disabled'})
                .prepend($('<span>')
                .addClass('fa fa-fw fa-spin fa-spinner loading'), ' ');

            await fetch('{{ route('panel.address.store.json') }}', {
                method: 'post',
                body: new FormData(addressForm),
                headers: {
                    'X-CSRF-Token':  '{{ csrf_token() }}'
                },
            }).then(() => {
                location.reload();
            });
        });

        function clearForm() {
            document.getElementById('district').value = ('');
            document.getElementById('city').value = ('');
            document.getElementById('street').value = ('');
            document.getElementById('uf').value = ('');
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
            if (!cep != '') {
                clearForm();
                return false;
            }

            var cepValidate = /^[0-9]{8}$/;
            if (!cepValidate.test(cep)) {
                clearForm();
                alert('Formato de CEP inválido.');

                return false;
            }

            document.getElementById('district').value = '...';
            document.getElementById('city').value = '...';
            document.getElementById('street').value = '...';
            document.getElementById('uf').value = '...';

            var script = document.createElement('script');
            script.src = `https://viacep.com.br/ws/${cep}/json/?callback=callback`;
            document.body.appendChild(script);
        }
    </script>
@endpush
