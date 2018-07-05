<?php

namespace App\Http\Controllers\Admin;

use App\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSeasonsRequest;
use App\Http\Requests\Admin\UpdateSeasonsRequest;

class SeasonsController extends Controller
{
    /**
     * Display a listing of Season.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('season_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('season_delete')) {
                return abort(401);
            }
            $seasons = Season::onlyTrashed()->get();
        } else {
            $seasons = Season::all();
        }

        return view('admin.seasons.index', compact('seasons'));
    }

    /**
     * Show the form for creating new Season.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('season_create')) {
            return abort(401);
        }
        return view('admin.seasons.create');
    }

    /**
     * Store a newly created Season in storage.
     *
     * @param  \App\Http\Requests\StoreSeasonsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSeasonsRequest $request)
    {
        if (! Gate::allows('season_create')) {
            return abort(401);
        }
        $season = Season::create($request->all());



        return redirect()->route('admin.seasons.index');
    }


    /**
     * Show the form for editing Season.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('season_edit')) {
            return abort(401);
        }
        $season = Season::findOrFail($id);

        return view('admin.seasons.edit', compact('season'));
    }

    /**
     * Update Season in storage.
     *
     * @param  \App\Http\Requests\UpdateSeasonsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSeasonsRequest $request, $id)
    {
        if (! Gate::allows('season_edit')) {
            return abort(401);
        }
        $season = Season::findOrFail($id);
        $season->update($request->all());



        return redirect()->route('admin.seasons.index');
    }


    /**
     * Display Season.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('season_view')) {
            return abort(401);
        }
        $salaries = \App\Salary::where('season_id', $id)->get();

        $season = Season::findOrFail($id);

        return view('admin.seasons.show', compact('season', 'salaries'));
    }


    /**
     * Remove Season from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('season_delete')) {
            return abort(401);
        }
        $season = Season::findOrFail($id);
        $season->delete();

        return redirect()->route('admin.seasons.index');
    }

    /**
     * Delete all selected Season at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('season_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Season::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Season from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('season_delete')) {
            return abort(401);
        }
        $season = Season::onlyTrashed()->findOrFail($id);
        $season->restore();

        return redirect()->route('admin.seasons.index');
    }

    /**
     * Permanently delete Season from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('season_delete')) {
            return abort(401);
        }
        $season = Season::onlyTrashed()->findOrFail($id);
        $season->forceDelete();

        return redirect()->route('admin.seasons.index');
    }
}
