<?php

namespace App\Services;

use GuzzleHttp\Client;

class VietnamProvinceService
{
    private function makeRequest($url)
    {
        $client = new Client;
        $response = $client->request('GET', $url);

        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody(), true);
        } else {
            return [];
        }
    }

    public function getDataVietnamProvince()
    {
        $url = config('const.api_vietnam_province') . '?depth=1';
        return $this->makeRequest($url);
    }

    public function getDataDistrictOfProvince($code)
    {
        $url = config('const.api_vietnam_province') . 'p/' . $code . '/?depth=2';
        return $this->makeRequest($url);
    }

    public function getDataWardOfDistrict($code)
    {
        $url = config('const.api_vietnam_province') . 'd/' . $code . '/?depth=2';
        return $this->makeRequest($url);
    }
}
