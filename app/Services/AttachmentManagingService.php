<?php

namespace App\Services;

use App\Models\Application;
use App\Models\Attachment;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AttachmentManagingService
{
    public function create(Application $application, UploadedFile $file, string $folder): Attachment
    {
        $path = $file->storeAs($folder, $file->getClientOriginalName());

        return $application->attachments()->create(['path' => $path]);
    }

    public function fileExists(string $path): bool
    {
        return Storage::exists($path);
    }

    public function download(Attachment $attachment): StreamedResponse
    {
        return Storage::download($attachment->path);
    }

    public function delete(Attachment $attachment): int
    {
        return $attachment->delete();
    }
}
