<?php

namespace App\Http\Controllers;

use App\Models\ClicksModel;

class ClicksController extends Controller
{
    public function addClick(array $data)
    {
        $date = $data['date'];
        $x = $data['x'];
        $y = $data['y'];
        $domain = $_SERVER['REMOTE_ADDR'];
        $domainsController = new DomainsController();
        if ($domainsController->isDomainAvailable($domain)) {
            ClicksModel::addClick($date, $x, $y, $domain);
        }
    }

    public function getAllClicks(): array
    {
        return ClicksModel::getAllClicks();
    }

    public function getClicksForDomain(): array
    {
        $domain = $_SERVER['REMOTE_ADDR'];
        return ClicksModel::getClicksForDomain($domain);
    }
}
