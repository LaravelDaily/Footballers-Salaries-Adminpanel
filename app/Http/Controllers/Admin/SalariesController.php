<?php

namespace App\Http\Controllers\Admin;

use App\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSalariesRequest;
use App\Http\Requests\Admin\UpdateSalariesRequest;

class SalariesController extends Controller
{
    /**
     * Display a listing of Salary.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('salary_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('salary_delete')) {
                return abort(401);
            }
            $salaries = Salary::onlyTrashed()->get();
        } else {
            $salaries = Salary::all();
        }

        return view('admin.salaries.index', compact('salaries'));
    }

    /**
     * Show the form for creating new Salary.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('salary_create')) {
            return abort(401);
        }
        
        $players = \App\Player::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $seasons = \App\Season::get()->pluck('season', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.salaries.create', compact('players', 'teams', 'seasons'));
    }

    /**
     * Store a newly created Salary in storage.
     *
     * @param  \App\Http\Requests\StoreSalariesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSalariesRequest $request)
    {
        if (! Gate::allows('salary_create')) {
            return abort(401);
        }
        $salary = Salary::create($request->all());



        return redirect()->route('admin.salaries.index');
    }


    /**
     * Show the form for editing Salary.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('salary_edit')) {
            return abort(401);
        }
        
        $players = \App\Player::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $seasons = \App\Season::get()->pluck('season', 'id')->prepend(trans('global.app_please_select'), '');

        $salary = Salary::findOrFail($id);

        return view('admin.salaries.edit', compact('salary', 'players', 'teams', 'seasons'));
    }

    /**
     * Update Salary in storage.
     *
     * @param  \App\Http\Requests\UpdateSalariesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSalariesRequest $request, $id)
    {
        if (! Gate::allows('salary_edit')) {
            return abort(401);
        }
        $salary = Salary::findOrFail($id);
        $salary->update($request->all());



        return redirect()->route('admin.salaries.index');
    }


    /**
     * Display Salary.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('salary_view')) {
            return abort(401);
        }
        $salary = Salary::findOrFail($id);

        return view('admin.salaries.show', compact('salary'));
    }


    /**
     * Remove Salary from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('salary_delete')) {
            return abort(401);
        }
        $salary = Salary::findOrFail($id);
        $salary->delete();

        return redirect()->route('admin.salaries.index');
    }

    /**
     * Delete all selected Salary at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('salary_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Salary::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Salary from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('salary_delete')) {
            return abort(401);
        }
        $salary = Salary::onlyTrashed()->findOrFail($id);
        $salary->restore();

        return redirect()->route('admin.salaries.index');
    }

    /**
     * Permanently delete Salary from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('salary_delete')) {
            return abort(401);
        }
        $salary = Salary::onlyTrashed()->findOrFail($id);
        $salary->forceDelete();

        return redirect()->route('admin.salaries.index');
    }
}
