<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index()
    {
        return view('weather.index');
    }

    public function fetchWeather(Request $request)
    {
        $request->validate([
            'city' => 'required|string|max:255',
        ]);

        $city = $request->input('city');
        $apiKey =  env("OPENWEATHER_API_KEY");
        $response = Http::get("http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}");

        if ($response->successful()) {
            $weatherData = $response->json();
            return view('weather.index', compact('weatherData', 'city'));
        }

        return back()->withErrors(['city' => 'Could not fetch weather data. Please try again.']);
    }
}
