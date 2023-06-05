<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\DonateRequest;
use App\Http\Requests\PollRequest;
use App\Models\Category;
use App\Models\Donate;
use App\Models\Poll;
use App\Models\PollVariant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;


class DonateController extends Controller
{

    public function index(): View
    {
        return view(
            'admin.donate.index',
            [
                'models' => Donate::query()->get(),
            ]
        );
    }

    public function create(): View
    {
        return view(
            'admin.donate.create'
        );
    }

    public function show(Donate $donate): View
    {
        return view('admin.donate.show', ['model' => $donate]);
    }

    public function store(DonateRequest $request): RedirectResponse
    {
        $model = new Donate($request->validated());
        $model->save();

        return redirect(route('admin.donate.index'));
    }

    public function edit(Donate $donate): View
    {
        return view('admin.donate.edit', ['model' => $donate]);
    }

    public function update(DonateRequest $request, Donate $donate): RedirectResponse
    {
        $donate->fill($request->validated());
        $donate->save();

        return redirect(route('admin.donate.index'));
    }

    public function destroy(Donate $donate): RedirectResponse
    {
        $donate->delete();

        return redirect(route('admin.donate.index'));
    }
}
