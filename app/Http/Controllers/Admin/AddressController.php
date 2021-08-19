<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    /**
     * Find the resource by postal code
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */

    public function find(Request $request)
    {
        try {
            $cep = getOnlyNumber($request->get('cep'));
            $info = zipcode($cep);
            if (empty($info)) {
                throw new \Exception('CEP não encontrado.');
            }

            $response = $info->getArray();
        } catch (\Exception $e) {
            $response = [
                'error' => 1,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($response);
    }
}
