<?php

namespace App\Http\Controllers\Site;

use App\CartProduct;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class CartProductController extends Controller
{
    public function increaseCartProductQuantity(CartProduct $cartProduct)
    {
        try {
            $cartProduct->increaseQuantity();
            $response = [
                'error' => false,
            ];
        } catch (Exception $e) {
            $response = [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }

        return response()->json($response);
    }

    public function decreaseCartProductQuantity(CartProduct $cartProduct, Request $request)
    {
        try {
            $cartProduct->decreaseQuantity();
            $response = [
                'error' => false,
            ];
        } catch (Exception $e) {
            $response = [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }

        return response()->json($response);
    }

    public function removeProduct(CartProduct $cartProduct)
    {
        $cartProduct->delete();

        return redirect()->route('cart')->withSuccess('Produto removido com sucesso!');
    }
}
