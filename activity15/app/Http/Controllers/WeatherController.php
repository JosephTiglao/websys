<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getWeather(Request $request)
    {
        $apiKey = env('OPENWEATHER_API_KEY');

        $city1 = $request->query('city1', 'London'); // Default to London
        $response1 = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'q' => $city1,
            'appid' => $apiKey,
            'units' => 'metric'
        ]);

        $city2 = $request->query('city2', 'London'); // Default to London
        $response2 = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'q' => $city2,
            'appid' => $apiKey,
            'units' => 'metric'
        ]);

        $city3 = $request->query('city3', 'London'); // Default to London
        $response3 = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'q' => $city3,
            'appid' => $apiKey,
            'units' => 'metric'
        ]);

        if ($response1->successful() && $response2->successful() && $response3->successful()) {
            $data1 = [
                'city' => $response1['name'],
                'temperature' => $response1['main']['temp'],
                'description' => $response1['weather'][0]['description'],
                'humidity' => $response1['main']['humidity']
            ];

            $data2 = [
                'city' => $response2['name'],
                'temperature' => $response2['main']['temp'],
                'description' => $response2['weather'][0]['description'],
                'humidity' => $response2['main']['humidity']
            ];

            $data3 = [
                'city' => $response3['name'],
                'temperature' => $response3['main']['temp'],
                'description' => $response3['weather'][0]['description'],
                'humidity' => $response3['main']['humidity']
            ];

            return view('weather', [
                'city1' => json_encode($data1, JSON_PRETTY_PRINT),
                'city2' => json_encode($data2, JSON_PRETTY_PRINT),
                'city3' => json_encode($data3, JSON_PRETTY_PRINT),
            ]);
        } else {
            return response()->json(['error' => 'Could not fetch weather data'], 400);
        }
    }
}
