<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
class DomainsModel extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        self::domain
    ];

    protected const domain = 'domain';

    protected $table = 'allowed_domains';

    public static function isDomainAvailable(string $domainName): bool
    {
        return DomainsModel::where(self::domain, '=', $domainName)->count() > 0;
    }

    public static function addNewDomain(string $newDomainName): void
    {
        if (!self::isDomainAvailable($newDomainName)) {
            DomainsModel::create([self::domain => $newDomainName]);
        }
    }

    public static function deleteDomain(string $domainName): void
    {
        DomainsModel::where([self::domain, '=', $domainName])->delete();
    }

    public static function getAllDomains(): array
    {
        return DomainsModel::select()->toArray();
    }
}
