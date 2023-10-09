<?php

namespace App\Services;

use App\Models\Application;
use App\Models\Communication;
use App\Models\User;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class CommunicationSendingService
{
    private ?PendingRequest $baseRequest = null;

    private function baseRequest(): PendingRequest
    {
        if (is_null($this->baseRequest)) {
            $this->baseRequest = Http::baseUrl(config('sevima.notification.url') . '/api/v1')
                ->withHeaders([
                    'app-id' => config('sevima.notification.app_id'),
                    'app-secret' => config('sevima.notification.app_secret'),
                ])->timeout(30);
        }

        return $this->baseRequest;
    }

    public function getAllCommunications(): array|false
    {
        try {
            return $this->baseRequest()
                ->get('/notifications')
                ->json()['data'];
        } catch (\Exception) {
            return false;
        }
    }

    public function create(Application $application, User $sender, string $subject, string $content): true
    {
        $response = $this->baseRequest()
            ->post('/notifications', [
                'channel' => 'email',
                'subject' => $subject,
                'message' => $content,
                'sender_name' => $sender->name,
                'from' => $sender->email,
                'to' => $application->applicant->email,
            ])->json();

        Communication::query()->create([
            'title' => $subject,
            'content' => $content,
            'application_id' => $application->id,
            'user_id' => $sender->id,
        ]);

        if ($response['status'] !== 202) {
            throw new \Exception('Error sending email: ' . $response['message']);
        }

        return true;
    }
}
