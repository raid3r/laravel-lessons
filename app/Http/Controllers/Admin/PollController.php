<?php

namespace App\Http\Controllers\Admin;

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


class PollController extends Controller
{

    public function index(): View
    {
        return view(
            'admin.poll.index',
            [
                'models' => Poll::query()->get(),
            ]
        );
    }

    public function create(): View
    {
        return view(
            'admin.poll.create'
        );
    }

    public function show(Poll $poll): RedirectResponse
    {
        return redirect()->route('poll-show-votes', [$poll]);
        //return view('admin.poll.show', ['poll' => $poll]);
    }

    public function store(PollRequest $request): RedirectResponse
    {
        $poll = new Poll($request->validated());
        $poll->save();

        return redirect(route('poll.index'));
    }

    public function storeVariant(Poll $poll, Request $request): RedirectResponse
    {
        $variant = new PollVariant($request->validate(['text' => 'required|max:500']));
        $variant->poll_id = $poll->id;
        $variant->save();

        return redirect()->route('poll.edit', [$poll]);
    }

    public function edit(Poll $poll): View
    {
        return view('admin.poll.edit', ['model' => $poll]);
    }

    public function update(PollRequest $request, Poll $poll): RedirectResponse
    {
        $poll->fill($request->validated());
        $poll->save();

        return redirect()->route('poll.index');
    }

    public function destroy(Poll $poll): RedirectResponse
    {
        $poll->delete();

        return redirect()->route('poll.index');
    }

    public function destroyVariant(Poll $poll, PollVariant $variant): RedirectResponse
    {
        $variant->delete();

        return redirect()->route('poll.edit', [$poll]);
    }
}
