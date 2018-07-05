<?php

namespace App\Http\Controllers\Admin;

use App\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePlayersRequest;
use App\Http\Requests\Admin\UpdatePlayersRequest;

class PlayersController extends Controller
{
    /**
     * Display a listing of Player.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('player_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('player_delete')) {
                return abort(401);
            }
            $players = Player::onlyTrashed()->get();
        } else {
            $players = Player::all();
        }

        return view('admin.players.index', compact('players'));
    }

    /**
     * Show the form for creating new Player.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('player_create')) {
            return abort(401);
        }
        
        $nationalities = \App\Country::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.players.create', compact('nationalities'));
    }

    /**
     * Store a newly created Player in storage.
     *
     * @param  \App\Http\Requests\StorePlayersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlayersRequest $request)
    {
        if (! Gate::allows('player_create')) {
            return abort(401);
        }
        $player = Player::create($request->all());



        return redirect()->route('admin.players.index');
    }


    /**
     * Show the form for editing Player.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('player_edit')) {
            return abort(401);
        }
        
        $nationalities = \App\Country::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        $player = Player::findOrFail($id);

        return view('admin.players.edit', compact('player', 'nationalities'));
    }

    /**
     * Update Player in storage.
     *
     * @param  \App\Http\Requests\UpdatePlayersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlayersRequest $request, $id)
    {
        if (! Gate::allows('player_edit')) {
            return abort(401);
        }
        $player = Player::findOrFail($id);
        $player->update($request->all());



        return redirect()->route('admin.players.index');
    }


    /**
     * Display Player.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('player_view')) {
            return abort(401);
        }
        
        $nationalities = \App\Country::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');$salaries = \App\Salary::where('player_id', $id)->get();

        $player = Player::findOrFail($id);

        return view('admin.players.show', compact('player', 'salaries'));
    }


    /**
     * Remove Player from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('player_delete')) {
            return abort(401);
        }
        $player = Player::findOrFail($id);
        $player->delete();

        return redirect()->route('admin.players.index');
    }

    /**
     * Delete all selected Player at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('player_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Player::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Player from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('player_delete')) {
            return abort(401);
        }
        $player = Player::onlyTrashed()->findOrFail($id);
        $player->restore();

        return redirect()->route('admin.players.index');
    }

    /**
     * Permanently delete Player from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('player_delete')) {
            return abort(401);
        }
        $player = Player::onlyTrashed()->findOrFail($id);
        $player->forceDelete();

        return redirect()->route('admin.players.index');
    }
}
