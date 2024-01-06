<?php

namespace TioJobs\AsaasPhp\Endpoints\Notifications;

use TioJobs\AsaasPhp\Concerns\HasIdAndData;
use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Concerns\HasNullableToken;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;
use TioJobs\AsaasPhp\DataTransferObjects\Notifications\UpdateNotificationDTO;

class UpdateNotification implements AsaasInterface
{
    use HasMode;
    use HasNullableToken;

    public function __construct(
        public readonly string $apiKey,
        public readonly string $notificationId,
        public readonly UpdateNotificationDTO $updateNotificationDTO,
    ) { }

    public function getPath(): string
    {
        $endpoint = config("asaas-php.mode.{$this->getMode()}.url");

        return "{$endpoint}/notifications/{$this->notificationId}";
    }

    public function getData(): array
    {
        $data = [
            'enabled' => $this->updateNotificationDTO->enabled,
            'emailEnabledForProvider' => $this->updateNotificationDTO->emailEnabledForProvider,
            'smsEnabledForProvider' => $this->updateNotificationDTO->smsEnabledForProvider,
            'emailEnabledForCustomer' => $this->updateNotificationDTO->emailEnabledForCustomer,
            'smsEnabledForCustomer' => $this->updateNotificationDTO->smsEnabledForCustomer,
            'phoneCallEnabledForCustomer' => $this->updateNotificationDTO->phoneCallEnabledForCustomer,
            'whatsappEnabledForCustomer' => $this->updateNotificationDTO->whatsappEnabledForCustomer,
        ];

        if (!is_null($this->updateNotificationDTO->scheduleOffset?->value)) {
            $merge = [
                'scheduleOffset' => $this->updateNotificationDTO->scheduleOffset?->value,
            ];

            $data = array_merge($data, $merge);
        }

        return $data;
    }
}
