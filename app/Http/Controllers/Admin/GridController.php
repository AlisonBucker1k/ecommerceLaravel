<?php

namespace App\Http\Controllers\Admin;

use App\Enums\GridStatus;
use App\Enums\GridVariationStatus;
use App\Grid;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;


class GridController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = $this->filters($request);

        $data['listStatus'] = GridStatus::getInstances();
        $data['grids'] = Grid::query()->where($filters)->orderBy('description')->paginate(20);
        $data['filters'] = $filters;
        $data['breadcrumb'] = [
            'Grades' => route('grids.list')
        ];

        return view('admin.grid.index', $data);
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

        return $filters;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Nova Grade';
        $data['listStatus'] = GridStatus::getInstances();
        $data['breadcrumb'] = [
            'Grades' => route('grids.list'),
            'Nova Grade' => route('grid.create')
        ];

        return view('admin.grid.form', $data);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:grids,description',
            'status' => 'required'
        ]);

        $grid = new Grid();
        $grid->description = $request->name;
        $grid->status = $request->status;
        $grid->save();

        return redirect()->route('grid.edit', $grid->id)->withSuccess('Grade adicionada com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Grid $grid
     * @return \Illuminate\Http\Response
     */
    public function edit(Grid $grid)
    {
        $data['title'] = 'Editar Grade';
        $data['grid'] = $grid;
        $data['variations'] = $grid->variations()->get();
        $data['listStatus'] = GridStatus::getInstances();
        $data['listVariationStatus'] = GridVariationStatus::getInstances();
        $data['breadcrumb'] = [
            'Grades' => route('grids.list'),
            'Editar Grade' => route('grid.edit', $grid->id)
        ];

        return view('admin.grid.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Grid $grid
     * @return RedirectResponse
     */
    public function update(Request $request, Grid $grid)
    {
        $request->validate([
            'name' => 'required|unique:grid_variations,description',
            'status' => 'required',
        ]);

        $grid->description = $request->name;
        $grid->status = $request->status;

        $grid->save();

        return back()->withInput()->withSuccess('Grade atualizado com sucesso!');
    }

    /**
     * @param Grid $grid
     * @return mixed
     * @throws \Exception
     */
    public function destroy(Grid $grid)
    {
        Log::info('Grade removida por ' . auth()->user()->name, ['user_id' => auth()->id(), 'grid' => $grid]);

        $grid->delete();

        return back()->withSuccess('Grade removida com sucesso!');
    }
}
