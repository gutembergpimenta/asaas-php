<?php

namespace TioJobs\AsaasPhp\Endpoints\Charges\Resources;

use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Concerns\HasPagination;
use TioJobs\AsaasPhp\Contracts\Core\AsaasChargeInterface;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;
use TioJobs\AsaasPhp\DataTransferObjects\Charges\Billet\DirectBilletDTO;

class ListAllCharges implements AsaasInterface
{
    use HasPagination;
    use HasMode;

    public function getPath(): string
    {
        $endpoint = config("asaas-php.mode.{$this->getMode()}.url");

        return "{$endpoint}/payments?limit={$this->limit}&offset={$this->offset}";
    }

    public function getData(): array
    {
        return [];
    }
}
