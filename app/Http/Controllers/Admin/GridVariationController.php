<?php

namespace App\Http\Controllers\Admin;

use App\Enums\GridStatus;
use App\Enums\GridVariationStatus;
use App\Grid;
use App\GridVariation;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;


class GridVariationController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request, Grid $grid)
    {
        $request->validate([
            'description' => [
                'required',
                Rule::unique('grid_variations')->where(function ($query) use($grid) {
                    $query->where('grid_id', $grid->id);
                })
            ],
            'grid_id' => 'required',
        ]);

        $gridVariation = new GridVariation();
        $gridVariation->fill($request->all() + ['status' => 1]);
        $gridVariation->save();

        return back()->withSuccess('Variação cadastrada com sucesso!');
    }

    /**
     * @param Request $request
     * @param Grid $grid
     * @param GridVariation $gridVariation
     * @return mixed
     */
    public function update(Request $request, Grid $grid, GridVariation $gridVariation)
    {
        $request->validate([
            'description' => [
                'required',
                Rule::unique('grid_variations')->where(function ($query) use($grid) {
                    $query->where('grid_id', $grid->id);
                })->ignore($gridVariation->id)
            ],
            'status' => 'required',
        ]);

        $gridVariation->description = $request->description;
        $gridVariation->status = $request->status;
        $gridVariation->update();

        return back()->withSuccess('Variação alterada com sucesso!');
    }

    /**
     * @param Grid $grid
     * @param GridVariation $gridVariation
     * @return mixed
     * @throws \Exception
     */
    public function destroy(Grid $grid, GridVariation $gridVariation)
    {
        Log::info('Variação da grade removida por ' . auth()->user()->name, ['user_id' => auth()->id(), 'grid_variation' => $gridVariation]);

        $gridVariation->delete();

        return back()->withSuccess('Variação da grade removida com sucesso!');
    }
}
