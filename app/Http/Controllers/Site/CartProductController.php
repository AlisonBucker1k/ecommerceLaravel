<?php

namespace App\Http\Controllers\Site;

use App\CartProduct;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class CartProductController extends Controller
{
    public function removeProduct(CartProduct $cartProduct)
    {
        $cartProduct->delete();

        return redirect()->route('cart')->withSuccess('Produto removido com sucesso!');
    }

    public function changeQuantity(Request $request, CartProduct $cartProduct)
    {
        try {
            $cartProduct->changeQuantity($request->post('new_quantity'));
            $response = [
                'error' => false,
                'cart_product' => $cartProduct,
            ];
        } catch (Exception $e) {
            $response = [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }

        return response()->json($response);
    }
}
