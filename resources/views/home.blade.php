@extends('layout')
@section('content')
    <div class="main-search-input-wrap">
        <div class="main-search-input fl-wrap">
            <div class="main-search-input-item">
                <form method="POST" action={{ route('checkWeather') }}>
                    @csrf
                    <input type="text" name="searchInput" placeholder="Your City...">
            </div>
            <button class="main-search-button">Search</button>
        </div>
        </form>
    </div>
    <div class='container-weather-card'>
        @if (isset($key['data']))
            <div class='city-name'>{{ $key['city'] }}</div>
            <div class="weather-cards">
                @for ($i = 0; $i < $key['index']; $i++)
                    <div class='weather-card'>
                        {{$key['days'][$i]}}
                        <div class='weather-icon'>
                            <img src="http://openweathermap.org/img/w/{{ $key['data'][$i]['weather'][0]['icon'] }}.png">
                        </div>
                     <h3>{{$key['data'][$i]['temp']['day']}}°C</h3>
                        <div class='weather-name'>{{ $key['data'][$i]['weather'][0]['description'] }}
                        </div>
                    </div>
                @endfor
            @else
                <h1> {{ $key['message'] }}</h1>
        @endif
    </div>
    </div>
    <div>
    </div>
@endsection
