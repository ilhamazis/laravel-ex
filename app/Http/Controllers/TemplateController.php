<?php

namespace App\Http\Controllers;

use App\Enums\PermissionEnum;
use App\Http\Requests\StoreTemplateRequest;
use App\Models\Template;
use App\Services\TemplateManagingService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TemplateController extends Controller
{
    private TemplateManagingService $templateManagingService;

    public function __construct(TemplateManagingService $templateManagingService)
    {
        $this->templateManagingService = $templateManagingService;

        $this->middleware('can:' . PermissionEnum::VIEW_TEMPLATE->value)->only(['index', 'show']);
        $this->middleware('can:' . PermissionEnum::CREATE_TEMPLATE->value)->only(['create', 'store']);
        $this->middleware('can:' . PermissionEnum::UPDATE_TEMPLATE->value)->only(['edit', 'update']);
        $this->middleware('can:' . PermissionEnum::DELETE_TEMPLATE->value)->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('managements.templates.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return response()->json(
            $this->templateManagingService
                ->findOrFail($id)
                ->only(['content'])
        );
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
     * Show the form for editing the specified resource.
     */
    public function edit(Template $template): View
    {
        return view('managements.templates.edit', ['template' => $template]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTemplateRequest $request, Template $template)
    {
        $this->templateManagingService->update($template, $request->validated());

        return redirect()
            ->route('managements.templates.index')
            ->with('success', 'Berhasil mengubah template');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = $request->validate(['id' => ['required', Rule::exists(Template::class, 'id')]]);

        $this->templateManagingService->delete($data['id']);

        return redirect()
            ->route('managements.templates.index')
            ->with('success', 'Berhasil menghapus template');
    }
}
