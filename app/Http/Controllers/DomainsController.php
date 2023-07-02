<?php

namespace App\Http\Controllers;

use App\Models\DomainsModel;

class DomainsController extends Controller
{
    public function isDomainAvailable(string $domainName): bool
    {
        return DomainsModel::isDomainAvailable($domainName);
    }

    public function addNewDomain(array $data): void
    {
        $newDomainName = $data['newDomain'];
        DomainsModel::addNewDomain($newDomainName);
    }

    public function deleteDomain(array $data): void
    {
        $domainName = $data['newDomain'];
        DomainsModel::deleteDomain($domainName);
    }

    public function getAllDomains(): array
    {
        return DomainsModel::getAllDomains();
    }
}
