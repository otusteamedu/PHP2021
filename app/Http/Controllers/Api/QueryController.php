<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\QueryActionJob;
use App\Models\Query;
use Illuminate\Http\Request;

class QueryController extends Controller
{

    public function create(Request $request)
    {
        $this->validate($request, ['text' => 'required|string']);
        $queryId = \Illuminate\Support\Str::uuid();
        dispatch(new QueryActionJob($queryId, $request->get('text')));
        return response(['id' => $queryId]);
    }

    public function update(Request $request) {
        $this->validate($request, ['id' => 'required|exists:queries', 'text' => 'string']);
        dispatch(new QueryActionJob($request->get('id'), $request->get('text')));
        return response('OK');
    }

    public function get($id)
    {
        $query = Query::query()->select('text')->findOrFail($id);
        return response($query);
    }
}
