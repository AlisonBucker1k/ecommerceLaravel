<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Enums\CategoryStatus;
use App\Enums\SubcategoryStatus;
use App\Subcategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = $this->filters($request);

        $data['listStatus'] = CategoryStatus::getInstances();
        $data['categories'] = Category::query()->where($filters)->orderBy('id', 'desc')->paginate(20);
        $data['breadcrumb'] = [
            'Categorias' => route('categories.list')
        ];

        return view('admin.category.index', $data);
    }

    /**
     * @param  Request $request
     * @return array
     */
    private function filters(Request $request)
    {
        $filters = [];

        if (is_numeric($request->status)) {
            $filters['status'] = $request->status;
        }

        if (!empty($request->name)) {
            $filters['name'] = $request->name;
        }

        return $filters;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Nova Categoria';
        $data['listStatus'] = CategoryStatus::getInstances();
        $data['breadcrumb'] = [
            'Categorias' => route('categories.list'),
            'Nova Categoria' => route('category.create')
        ];

        return view('admin.category.form', $data);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
            'status' => 'required'
        ]);

        $category = new Category();
        $category->fill($request->all());
        $category->save();

        return redirect()->route('category.edit', [$category->slug])->withSuccess('Categoria adicionada com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $data['title'] = 'Editar Categoria';
        $data['category'] = $category;
        $data['listStatus'] = CategoryStatus::getInstances();
        $data['subcategories'] = $category->subcategories()->get();
        $data['breadcrumb'] = [
            'Categorias' => route('categories.list'),
            'Editar Categoria' => route('category.edit', $category)
        ];

        return view('admin.category.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Category $category
     * @return RedirectResponse
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required', Rule::unique('categories', 'id')->ignore($category)],
            'status' => 'required'
        ]);

        $category->fill($request->all());
        $category->save();

        return redirect()->route('categories.list')->withSuccess('Categoria alterada com sucesso!');
    }

    /**
     * @param Category $category
     * @return mixed
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        Log::info('Categoria removida por ' . auth()->user()->name, ['category' => $category, 'user_id' => auth()->id()]);

        $category->delete();

        return back()->withSuccess('Categoria removida com sucesso!');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function subcategories(Request $request)
    {
        return response()->json(Subcategory::where(['category_id' => $request->get('category_id'), 'status' => SubcategoryStatus::ACTIVE])->get());
    }
}
