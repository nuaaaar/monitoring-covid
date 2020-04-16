<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class CovidController extends Controller
{
    public function index()
    {
        $data["countries"] = $this->countries();
        if (isset($_GET['country'])) {
            if ($_GET['country'] != '' && $_GET['country'] != null) {
                $data["covids"] = $this->countryData($_GET['country']);
            }else {
                $data["covids"] = $this->globalData();
            }
        }else {
            $data["covids"] = $this->globalData();
        }

        return view('pages.dashboard', $data);
    }

    public function countries()
    {
        $response = Http::get('https://restcountries.eu/rest/v2/all')->json();

        return $response;
    }

    public function globalData()
    {
        $response = Http::get('https://covidapi.info/api/v1/global/count')->json();

        $covidData = [];
        foreach (array_reverse($response["result"], true) as $key => $result) {
            $data["date"] = $key;
            $data["confirmed"] = $result["confirmed"];
            $data["recovered"] = $result["recovered"];
            $data["deaths"] = $result["deaths"];

            array_push($covidData, $data);
        }

        return $covidData;
    }

    public function countryData($countryCode)
    {
        $response = Http::get('https://covidapi.info/api/v1/country/'. $countryCode)->json();

        $covidData = [];
        foreach (array_reverse($response["result"], true) as $key => $result) {
            $data["date"] = $key;
            $data["confirmed"] = $result["confirmed"];
            $data["recovered"] = $result["recovered"];
            $data["deaths"] = $result["deaths"];

            array_push($covidData, $data);
        }

        return $covidData;
    }
}
