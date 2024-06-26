@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Weather Forecast</h1>

        <form action="{{ route('weather.fetch') }}" method="POST" class="mb-4">
            @csrf
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" name="city" id="city" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Get Weather</button>
        </form>

        @if(isset($weatherData))
            <div class="card">
                <div class="card-body">
                    <h2>{{ $city }}</h2>
                    <p>Temperature: {{ $weatherData['main']['temp'] }} K</p>
                    <p>Weather: {{ $weatherData['weather'][0]['description'] }}</p>
                    <p>Humidity: {{ $weatherData['main']['humidity'] }}%</p>
                    <p>Wind Speed: {{ $weatherData['wind']['speed'] }} m/s</p>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger mt-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
