<?php

namespace Modules\Map\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\PollRequest;
use App\Models\Category;
use App\Models\Poll;
use App\Models\PollVariant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Modules\Map\Entities\Marker;
use Modules\Map\Http\Requests\MarkerRequest;


class MapController extends Controller
{

    public function index(): View
    {
        return view(
            'map::admin.map.index',
            [
                'models' => Marker::query()->get(),
            ]
        );
    }

    public function create(): View
    {
        return view(
            'map::admin.map.create',
        );
    }

    // TODO ???
    public function show(Poll $poll): RedirectResponse
    {
        return redirect()->route('poll-show-votes', [$poll]);
        //return view('admin.poll.show', ['poll' => $poll]);
    }

    public function store(MarkerRequest $request): RedirectResponse
    {
        $model = new Marker($request->validated());
        $model->save();

        return redirect(route('map::admin.map.index'));
    }

    public function edit(Marker $marker): View
    {
        return view('map::admin.map.edit', ['model' => $marker]);
    }

    public function update(MarkerRequest $request, Marker $marker): RedirectResponse
    {
        $marker->fill($request->validated());
        $marker->save();

        return redirect()->route('admin.map.index');
    }

    public function destroy(Marker $marker): RedirectResponse
    {
        $marker->delete();

        return redirect()->route('admin.map.index');
    }
}
