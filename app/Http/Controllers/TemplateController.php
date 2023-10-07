<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTemplateRequest;
use App\Services\TemplateManagingService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    private TemplateManagingService $templateManagingService;

    public function __construct(TemplateManagingService $templateManagingService)
    {
        $this->templateManagingService = $templateManagingService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('managements.templates.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('managements.templates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTemplateRequest $request): RedirectResponse
    {
        $this->templateManagingService->create($request->validated());

        return redirect()
            ->route('managements.templates.index')
            ->with('success', 'Berhasil menambahkan template');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
