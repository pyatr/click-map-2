<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
class ClicksModel extends Model
{
    use HasFactory;

    //To avoid Unknown column 'updated_at' error
    public $timestamps = false;

    protected $fillable = [
        self::x,
        self::y,
        self::date,
        self::domain
    ];

    protected const x = 'x';
    protected const y = 'y';
    protected const date = 'date';
    protected const domain = 'domain';


    protected $table = "clicks";

    public static function addClick(string $date, int $x, int $y, string $domain)
    {
        ClicksModel::create([
            self::date => $date,
            self::x => $x,
            self::y => $y,
            self::domain => $domain]);
    }

    public static function getAllClicks(): array
    {
        return ClicksModel::select()->get()->toArray();
    }

    public static function getClicksForDomain(string $domain): array
    {
        return ClicksModel::where(self::domain, '=', $domain)->get()->toArray();
    }
}
