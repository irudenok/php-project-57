<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLabelRequest;
use App\Http\Requests\UpdateLabelRequest;
use App\Models\Label;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LabelController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Label::class, 'label');
    }

    public function index(): View
    {
        $labels = Label::orderBy('id')->paginate(10);
        return view('labels.index', compact('labels'));
    }

    public function create(): View
    {
        $label = new Label();
        return view('labels.create', compact('label'));
    }

    public function store(StoreLabelRequest $request): RedirectResponse
    {
        Label::create($request->validated());
        flash('Метка успешно создана')->success();
        return redirect()->route('labels.index');
    }

    public function edit(Label $label): View
    {
        return view('labels.edit', compact('label'));
    }

    public function update(UpdateLabelRequest $request, Label $label): RedirectResponse
    {
        $label->update($request->validated());
        flash('Метка успешно изменена')->success();
        return redirect()->route('labels.index');
    }

    public function destroy(Label $label): RedirectResponse
    {
        if ($label->tasks()->exists()) {
            flash('Не удалось удалить метку')->error();
            return redirect()->route('labels.index');
        }

        $label->delete();
        flash('Метка успешно удалена')->success();
        return redirect()->route('labels.index');
    }
}
