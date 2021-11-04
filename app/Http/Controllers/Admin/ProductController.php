<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Enums\CategoryStatus;
use App\Enums\ProductStatus;
use App\Enums\SubcategoryStatus;
use App\Grid;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Product;
use App\ProductGrid;
use App\ProductImage;
use App\ProductVariation;
use App\Subcategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Product::query();
        $this->filters($request, $query);

        $data['listStatus'] = ProductStatus::getInstances();
        $data['products'] = $query->orderBy('id', 'desc')->paginate(10);
        $data['categories'] = Category::query()->where('status', CategoryStatus::ACTIVE)->get();
        $data['subcategories'] = Subcategory::query()->where('status', SubcategoryStatus::ACTIVE)->get();
        $data['breadcrumb'] = [
            'Produtos' => route('products.list')
        ];

        return view('admin.product.index', $data);
    }

    /**
     * @param Request $request
     * @param Builder $query
     * @return array
     */
    private function filters(Request $request, Builder $query)
    {
        $filters = [];

        if (is_numeric($request->status)) {
            $query->whereStatus($request->status);
        }

        if (!empty($request->name)) {
            $query->where(DB::raw('products.name'), 'like' , '%' . $request->name . '%');
        }

        if (!empty($request->category_id)) {
            $query->where(DB::raw('products.category_id'), '=',$request->category_id);
        }

        if (!empty($request->subcategory_id)) {
            $query->where(DB::raw('products.subcategory_id'), '=',$request->subcategory_id);
        }

        return $filters;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $subcategories = [];
        $category = new Category();
        $grid = new Grid();
        if (!empty(old('category_id'))) {
            $subcategories = $category->query()->find(old('category_id'))->subcategories()->get();
        }

        $data['categories'] = $category->activeCategories();
        $data['subcategories'] = $subcategories;
        $data['grids'] = $grid->activeGrids();
        $data['listStatus'] = ProductStatus::getInstances();
        $data['breadcrumb'] = [
            'Produtos' => route('products.list'),
            'Novo Produto' => route('product.create')
        ];

        return view('admin.product.create', $data);
    }

    /**
     * @param ProductStoreRequest $request
     * @return mixed
     */
    public function store(ProductStoreRequest $request)
    {
        $product = null;

        DB::transaction(function() use ($request, &$product) {
            $inputs = $request->validated();

            $product = new Product();
            $product->saveProduct($inputs);

            if ($request->has_grid_variation) {
                $grids = $request->grids;
                foreach ($grids as $grid) {
                    $productGrid = new ProductGrid();
                    $productGrid->createProductGrid($product->id, $grid);
                }
            } else {
                $productVariation = new ProductVariation();
                $productVariation->saveProductVariation($inputs + ['product_id' => $product->id]);
            }

            $productImage = new ProductImage();
            $productImage->handleUploadedImages($product->id, $request->file('images'));
        });

        if ($request->has_grid_variation) {
            return redirect()->route('product.edit', $product->slug)->withSuccess('Produto criado com sucesso!');
        }

        return redirect()->route('products.list')->withSuccess('Produto criado com sucesso!');
    }

    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Product $product)
    {
        $subcategories = [];
        $category = new Category();
        $grid = new Grid();
        if (!empty(old('category', $product->category_id))) {
            $subcategories = $category->query()->find(old('category_id', $product->category_id))->subcategories()->get();
        }

        $data['product'] = $product;
        $data['categories'] = $category->activeCategories();
        $data['subcategories'] = $subcategories;
        $data['grids'] = $grid->activeGrids();
        $data['listStatus'] = ProductStatus::getInstances();
        $data['breadcrumb'] = [
            'Produtos' => route('products.list'),
            'Editar Produto' => route('product.edit', $product->slug)
        ];

        return view('admin.product.edit', $data);
    }

    /**
     * @param ProductUpdateRequest $request
     * @param Product $product
     * @return mixed
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        DB::transaction(function() use ($product, $request) {
            $product->saveProduct($request->validated());

            if (!$product->has_grid_variation) {
                $productVariation = $product->mainVariation()->first();
                $productVariation->saveProductVariation($request->validated());
            }

            $productImage = new ProductImage();
            $productImage->handleUploadedImages($product->id, $request->file('images'));
        });

        return redirect(route('products.list'))->withSuccess('Produto alterado com sucesso!');
    }

    /**
     * @param Product $product
     * @param ProductImage $productImage
     * @return mixed
     */
    public function removeImage(Product $product, ProductImage $productImage)
    {
        $productImage->deleteImage();

        return back()->withSuccess('Imagem removida com sucesso!');
    }

    /**
     * @param Product $product
     * @param ProductImage $productImage
     * @return mixed
     */
    public function mainImage(Product $product, ProductImage $productImage)
    {
        $productImage->defineMainImage();

        return back()->withSuccess('Imagem principal definida com sucesso!');
    }
}
