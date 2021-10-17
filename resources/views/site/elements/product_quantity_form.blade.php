<div class="quantity mb-5">
    <form id="product-quantity-form" method="post">
        <div class="cart-plus-minus">
            <input class="cart-plus-minus-box new-quantity-input" value="{{ $cartProduct->quantity }}" type="number" name="quantity" minlength="0">
            <a href="#" class="dec qtybutton decrease-quantity">
                <i class="fa fa-minus"></i>
            </a>
            <a href="#" class="inc qtybutton increase-quantity">
                <i class="fa fa-plus"></i>
            </a>
        </div>
    </form>
</div>

@push('js')
    <script>
        async function changeQuantity(quantity) {
            let form = new FormData();
            form.append('new_quantity', quantity);

            await fetch('{{ route('cart_product.change_quantity', [$cartProduct->id]) }}', {
                method: 'post',
                body: form,
                headers: {
                    'X-CSRF-Token':  '{{ csrf_token() }}'
                },
            }).then(response => {
                return response.json();
            }).then(data => {
                if (data.error) {
                    alert(data.message);
                    return false;
                }

                location.reload();
            });
        }

        let btnDecreaseQuantity = document.querySelector('.decrease-quantity');
        btnDecreaseQuantity.addEventListener('click', async event => {
            event.preventDefault();

            inputQuantity.value--;
            if (inputQuantity.value == 0) {
                if (!confirm('Deseja remover o produto?')) {
                    inputQuantity.value++;
                    return false;
                }
            }

            await changeQuantity(inputQuantity.value);
        });

        let btnIncreaseQuantity = document.querySelector('.increase-quantity');
        btnIncreaseQuantity.addEventListener('click', async event => {
            event.preventDefault();
            inputQuantity.value++;
            await changeQuantity(inputQuantity.value);
        });

        let inputQuantity = document.querySelector('.new-quantity-input');
        inputQuantity.addEventListener('blur', async event => {
            event.preventDefault();
            changeQuantity(inputQuantity.value);
        });
    </script>
@endpush


