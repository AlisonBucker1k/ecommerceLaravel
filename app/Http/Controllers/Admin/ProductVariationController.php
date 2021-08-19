<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Enums\ProductStatus;
use App\Enums\ProductVariationStatus;
use App\Http\Requests\ProductVariationRequest;
use App\Product;
use App\ProductImageVariation;
use App\ProductVariation;
use App\ProductVariationItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\Builder;

class ProductVariationController extends Controller
{
    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Product $product)
    {
        $category = new Category();

        $data['product'] = $product;
        $data['listStatus'] = ProductVariationStatus::getInstances();
        $data['categories'] = $category->activeCategories();
        $data['grids'] = $product->grids();

        return view('admin.product.variation.form', $data);
    }

    /**
     * @param ProductVariationRequest $request
     * @param Product $product
     * @return array
     * @throws ValidationException
     */
    public function store(ProductVariationRequest $request, Product $product)
    {
        $variations = $request->variations;
        $v = Validator::make([], []);
        $productVariationItem = new ProductVariationItem();
        $exists = $productVariationItem->checkExistsVariations($variations, $product->id);
        if ($exists) {
            $v->errors()->add('variations', 'Não é possível inserir essas opções de variação no produto pois já existe outra variação cadastrada com as mesmas opções.');
            throw new ValidationException($v);
        }

        DB::beginTransaction();

        try {
            $productVariation = new ProductVariation();
            $productVariation->saveProductVariation($request->validated() + ['product_id' => $product->id]);

            $grids = $product->grids()->get();
            foreach ($grids as $grid) {
                if (!isset($variations[$grid->id]) || empty($variations[$grid->id])) {
                    $v->errors()->add('variations', 'É obrigatório selecionar as variações das grades.');
                    throw new ValidationException($v);
                }

                $productVariationItem = new ProductVariationItem();
                $productVariationItem->saveItem($productVariation->id, $grid->id, $variations[$grid->id]);
            }

            DB::commit();
        } catch (ValidationException $e) {
            DB::rollBack();
            throw $e;
        }

        return [
            'variation_id' => $productVariation->id
        ];
    }

    /**
     * @param Product $product
     * @param ProductVariation $productVariation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Product $product, ProductVariation $productVariation)
    {
        $category = new Category();

        $data['product'] = $product;
        $data['variation'] = $productVariation;
        $data['productVariationItem'] = new ProductVariationItem();
        $data['listStatus'] = ProductVariationStatus::getInstances();
        $data['categories'] = $category->activeCategories();
        $data['grids'] = $product->grids();

        return view('admin.product.variation.form', $data);
    }

    /**
     * @param ProductVariationRequest $request
     * @param Product $product
     * @param ProductVariation $productVariation
     * @return array
     * @throws ValidationException
     */
    public function update(ProductVariationRequest $request, Product $product, ProductVariation $productVariation)
    {
        $variations = $request->variations;
        $v = Validator::make([], []);
        $productVariationItem = new ProductVariationItem();
        $exists = $productVariationItem->checkExistsVariations($variations, $product->id, $productVariation->id);
        if ($exists) {
            $v->errors()->add('variations', 'Não é possível inserir essas opções de variação no produto pois já existe outra variação cadastrada com as mesmas opções.');
            throw new ValidationException($v);
        }

        DB::beginTransaction();

        try {
            $productVariation->saveProductVariation($request->validated() + ['product_id' => $product->id]);

            $grids = $product->grids()->get();
            foreach ($grids as $grid) {
                if (!isset($variations[$grid->id]) || empty($variations[$grid->id])) {
                    $v->errors()->add('variations', 'É obrigatório selecionar as variações das grades.');
                    throw new ValidationException($v);
                }

                $productVariationItem = new ProductVariationItem();
                $productVariationItem->saveItem($productVariation->id, $grid->id, $variations[$grid->id]);
            }

            DB::commit();
        } catch (ValidationException $e) {
            DB::rollBack();
            throw $e;
        }

        return [
            'variation_id' => $productVariation->id
        ];
    }

    /**
     * @param Product $product
     * @param ProductVariation $productVariation
     * @return array
     * @throws ValidationException
     */
    public function destroy(Product $product, ProductVariation $productVariation)
    {
        $productVariation->remove();

        return [];
    }

    /**
     * @param Product $product
     * @param ProductVariation $productVariation
     * @return array
     * @throws ValidationException
     */
    public function defineMain(Product $product, ProductVariation $productVariation)
    {
        $v = Validator::make([], []);
        if ($productVariation->status != ProductVariationStatus::ACTIVE) {
            $v->errors()->add('variation', 'A variação só pode ser a principal se estiver ativa.');
            throw new ValidationException($v);
        }

        $productVariation->defineMain();

        return [
            'message' => 'Variação principal alterado com sucesso.'
        ];
    }

    /**
     * @param Request $request
     * @param Product $product
     * @param ProductVariation $productVariation
     * @return array
     */
    public function linkImage(Request $request, Product $product, ProductVariation $productVariation)
    {
        $productVariationId = $productVariation->id;

        $productImageVariation = new ProductImageVariation();
        $productImageVariation->linkImage($request->image_id, $productVariationId);

        return [];
    }

    /**
     * @param Request $request
     * @param Product $product
     * @param ProductVariation $productVariation
     * @return array
     */
    public function unlinkImage(Request $request, Product $product, ProductVariation $productVariation)
    {
        $productVariationId = $productVariation->id;

        $productImageVariation = new ProductImageVariation();
        $productImageVariation->unlinkImage($request->image_id, $productVariationId);

        return [];
    }

    /**
     * @param  Builder $query
     * @param  Request $request
     * @return array
     */
    private function filters(Builder $query, Request $request)
    {
        $filters = [];

        if (!empty($request->product)) {
            $query->where('product_id', $request->product);
        }

        return $filters;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function stockList(Request $request)
    {
        $query = ProductVariation::query();
        $filters = $this->filters($query, $request);

        $data['productVariations'] = $query->where($filters)
            ->orderBy('stock_quantity')
            ->paginate(10);
        $data['products'] = Product::where('status', ProductStatus::ACTIVE)->get();
        $data['breadcrumb'] = [
            'Produtos' => route('products.list'),
            'Relatório de Estoque' => route('stocks.list')
        ];

        return view('admin.stock.index', $data);
    }
}
