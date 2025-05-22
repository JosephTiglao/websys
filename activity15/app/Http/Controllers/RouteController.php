<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RouteController extends Controller
{
    public function getRouteSteps(Request $request)
    {
        $start = $request->query('start');
        $end = $request->query('end');

        $apiKey = env('ORS_API_KEY');

        $url = "https://api.openrouteservice.org/v2/directions/driving-car";


        $response = Http::get($url, [
            'api_key' => $apiKey,
            'start' => $start,
            'end' => $end,
        ]);

        if ($response->successful()) {

            return response()->json([
                'steps' => $response->json(),
            ]);
        } else {
            return response()->json(['error' => 'Unable to fetch directions'], 400);
        }
    }
}
