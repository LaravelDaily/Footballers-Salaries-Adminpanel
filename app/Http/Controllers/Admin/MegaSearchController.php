<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MegaSearchController extends Controller
{
    protected $models = [
        'Player' => 'global.players.title',
    ];

    public function search(Request $request)
    {

        $search = $request->input('search', false);
        $term = $search['term'];

        if (!$term) {
            abort(500);
        }

        $return = [];
        foreach ($this->models as $modelString => $translation) {
            $model = 'App\\' . $modelString;

            $query = $model::query();

            $fields = $model::$searchable;

            foreach ($fields as $field) {
                $query->orWhere($field, 'LIKE', '%' . $term . '%');
            }

            $results = $query->get();

            foreach ($results as $result) {
                $results_formated = $result->only($fields);
                $results_formated['model'] = trans($translation);
                $results_formated['fields'] = $fields;
                $fields_formated = [];
                foreach ($fields as $field) {
                    $fields_formated[$field] = title_case(str_replace('_', ' ', $field));
                }
                $results_formated['fields_formated'] = $fields_formated;

                $results_formated['url'] = url('/admin/' . str_plural(snake_case($modelString)) . '/' . $result->id);

                $return[] = $results_formated;
            }
        }

        return response()->json(['results' => $return]);
    }
}
