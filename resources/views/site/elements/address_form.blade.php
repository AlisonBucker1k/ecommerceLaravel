<div class="create-address contact-form-wrapper">
    <form class="address-form" method="post">
        <div class="form-group row">
            <div class="col-lg-4">
                <label>CEP</label>
                <input name="cep" id="cep" class="form-control cep" type="text" value="{{ old('cep') }}" onblur="findCep(this.value);" required="required">
            </div>
            <div class="col-lg-8">
                <label>Endereço</label>
                <input name="street" id="street" class="form-control" type="text" value="{{ old('street') }}" placeholder="Rua..." required="required">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-6">
                <label>Complemento</label>
                <input name="complement" class="form-control" type="text" value="{{ old('complement') }}" placeholder="Complemento, Ex: Apto 2014 - Torre Sul">
            </div>
            <div class="col-lg-6">
                <label>Referência</label>
                <input name="reference" class="form-control" type="text" value="{{ old('reference') }}" placeholder="Referência, Ex: Em frente ao colégio Estadual">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-3">
                <label>Número</label>
                <input name="number" class="form-control" type="text" value="{{ old('number') }}">
            </div>
            <div class="col-lg-3">
                <label>Cidade</label>
                <input name="city" id="city" class="form-control" type="text" value="{{ old('city') }}" required="required">
            </div>
            <div class="col-lg-3">
                <label>Estado</label>
                <input name="state" id="uf" class="form-control" type="text" value="{{ old('state') }}" required="required">
            </div>
            <div class="col-lg-3">
                <label>Bairro</label>
                <input name="district" id="district" class="form-control" type="text" value="{{ old('district') }}" placeholder="Bairro" required="required">
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
        let addressForm = document.querySelector('.address-form');
        addressForm.addEventListener('submit', async event => {
            event.preventDefault();

            let btn = $('#btn-add-address');
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

        function findCep(valor) {
            let cep = valor.replace(/\D/g, '');
            if (!cep != '') {
                clearForm();
                return false;
            }

            let cepValidate = /^[0-9]{8}$/;
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
            script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=callback';
            document.body.appendChild(script);
        }
    </script>
@endpush

