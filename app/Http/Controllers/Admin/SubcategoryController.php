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

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = $this->filters($request);

        $data['listStatus'] = SubcategoryStatus::getInstances();
        $data['categories'] = Category::all();
        $data['subcategories'] = Subcategory::query()->where($filters)->orderBy('id', 'desc')->paginate(20);
        $data['filters'] = $filters;
        $data['breadcrumb'] = [
            'Subcategorias' => route('subcategories.list')
        ];

        return view('admin.subcategory.index', $data);
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\RedirectResponse
     */
    private function filters(Request $request)
    {
        $filters = [];

        if (is_numeric($request->status)) {
            $filters['status'] = $request->status;
        }

        if (is_numeric($request->category_id)) {
            $filters['category_id'] = $request->category_id;
        }

        return $filters;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $data['title'] = 'Nova Subcategoria';
        $data['categories'] = Category::all();
        $data['listStatus'] = SubcategoryStatus::getInstances();
        $data['breadcrumb'] = [
            'Subcategorias' => route('subcategories.list'),
            'Nova Subcategoria' => route('subcategory.create')
        ];
        $data['redirect'] = (!empty($request->get('category')));

        return view('admin.subcategory.form', $data);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('subcategories', 'name')->where('category_id', $request->category_id)
            ],
            'status' => 'required',
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')
            ]
        ]);

        $subcategory = new Subcategory();
        $subcategory->fill($request->all());
        $subcategory->save();

        if ($request->redirect == '1') {
            return redirect()->route('category.edit', [$subcategory->category->slug])->withSuccess('Subcategoria adicionada com sucesso!');
        }

        return redirect()->route('subcategories.list')->withSuccess('Subcategoria adicionada com sucesso!');
    }

    /**
     * @param Subcategory $subcategory
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Subcategory $subcategory, Request $request)
    {
        $data['title'] = 'Editar Subcategoria';
        $data['categories'] = Category::all();
        $data['subcategory'] = $subcategory;
        $data['listStatus'] = SubcategoryStatus::getInstances();
        $data['breadcrumb'] = [
            'Subcategorias' => route('subcategories.list'),
            'Editar Subcategoria' => route('subcategory.edit', $subcategory)
        ];
        $data['redirect'] = (!empty($request->get('category')));

        return view('admin.subcategory.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Subcategory $subcategory
     * @return RedirectResponse
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('subcategories', 'name')->where('category_id', $request->category_id)->ignore($subcategory)
            ],
            'status' => 'required',
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')
            ]
        ]);

        $subcategory->fill($request->all());
        $subcategory->save();

        if ($request->redirect == '1') {
            return redirect()->route('category.edit', [$subcategory->category->slug])->withSuccess('Subcategoria alterada com sucesso!');
        }

        return redirect()->route('subcategories.list')->withSuccess('Subcategoria alterada com sucesso!');
    }

    /**
     * @param Subcategory $subcategory
     * @return mixed
     * @throws \Exception
     */
    public function destroy(Subcategory $subcategory)
    {
        Log::info('Subcategoria removida por ' . auth()->user()->name, ['subcategory' => $subcategory, 'user_id' => auth()->id()]);

        $subcategory->delete();

        return back()->withSuccess('Categoria removida com sucesso!');
    }
}
