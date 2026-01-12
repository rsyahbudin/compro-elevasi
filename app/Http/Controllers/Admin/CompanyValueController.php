<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyValueRequest;
use App\Models\CompanyValue;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class CompanyValueController extends Controller
{
    public function index(): Response
    {
        $values = CompanyValue::orderBy('order')->paginate(20);

        return Inertia::render('admin/values/Index', [
            'values' => $values,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('admin/values/Form', [
            'value' => null,
        ]);
    }

    public function store(StoreCompanyValueRequest $request): RedirectResponse
    {
        CompanyValue::create($request->validated());

        return redirect()->route('admin.values.index')
            ->with('success', 'Company value added successfully.');
    }

    public function edit(CompanyValue $value): Response
    {
        return Inertia::render('admin/values/Form', [
            'value' => $value,
        ]);
    }

    public function update(StoreCompanyValueRequest $request, CompanyValue $value): RedirectResponse
    {
        $value->update($request->validated());

        return redirect()->route('admin.values.index')
            ->with('success', 'Company value updated successfully.');
    }

    public function destroy(CompanyValue $value): RedirectResponse
    {
        $value->delete();

        return redirect()->route('admin.values.index')
            ->with('success', 'Company value deleted successfully.');
    }
}
