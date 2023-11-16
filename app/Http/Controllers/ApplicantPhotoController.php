<?php

namespace App\Http\Controllers;

use App\Enums\PermissionEnum;
use App\Models\Applicant;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ApplicantPhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:' . PermissionEnum::VIEW_APPLICATION->value);
    }

    public function __invoke(Applicant $applicant): BinaryFileResponse
    {
        return response()->file(Storage::path($applicant->photo));
    }
}
