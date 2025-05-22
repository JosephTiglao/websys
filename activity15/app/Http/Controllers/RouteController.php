<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class RouteController extends Controller
{
    function getCoordinates($placename)
    {
        $url = "https://api.openrouteservice.org/geocode/search";
        $apiKey = env('ORS_API_KEY');

        $response = Http::get($url, [
            'api_key' => $apiKey,
            'text' => $placename,
            'size' => 1,
        ]);

        if ($response->successful() && isset($response['features'][0]['geometry']['coordinates'])) {
            return $response['features'][0]['geometry']['coordinates'];
        }

        return null;
    }

    public function getRouteSteps(Request $request)
    {


        $validator = Validator::make(
            $request->all(),
            [
                'start' => "required",
                'end' => "required",
            ],
            [
                'start' => "The current location field is required",
                'end' => "The selected destination field is required",
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('route')->withErrors($validator)->withInput();
        }

        $startCoor = $this->getCoordinates($request->start);
        $endCoor = $this->getCoordinates($request->end);

        if ($startCoor == null && $endCoor == null) {
            return redirect()->route('route')->withErrors(['start' => "Invalid current location", 'end' => "Invalid selected destination"])->withInput();
        } else if ($startCoor == null) {
            return redirect()->route('route')->withErrors(['start' => "Invalid current location"])->withInput();
        } else if ($endCoor == null) {
            return redirect()->route('route')->withErrors(['end' => "Invalid selected destination"])->withInput();
        }

        $startLoc = $startCoor[0] . "," . $startCoor[1];
        $endLoc = $endCoor[0] . "," . $endCoor[1];

        $apiKey = env('ORS_API_KEY');

        $url = "https://api.openrouteservice.org/v2/directions/driving-car";


        $response = Http::get($url, [
            'api_key' => $apiKey,
            'start' => $startLoc,
            'end' => $endLoc,
        ]);

        if (isset($response['error'])) {
            return redirect()->route('route')->withErrors(['route' => $response['error']['message']]);
        }

        $steps = $response['features'][0]['properties']['segments'][0]['steps'];
        $start = $request->start;
        $end = $request->end;

        return view('route', compact('steps', 'start', 'end'));
    }
}
