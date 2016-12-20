@extends('layouts.app')
@section('content')
    @include('partials.errors')
    @if (isset($ticket))

    @else
    <form action="{{route('tickets.store')}}" method="post" class="col-md-8 col-md-offset-2">
    @endif
        {{csrf_field()}}
        <div class="form-group">
            <label for="title">Title</label>
            <input id="title" type="text" class="form-control" name="title" value="{{old('title')}}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="5">{{old('description')}}</textarea>
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input id="location" type="text" class="form-control" name="location" value="{{old('location')}}">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input id="price" type="text" class="form-control" name="price" value="{{old('price')}}">
        </div>
        <div class="form-group">
            <label for="event_date_day">Date</label>
            <br>
            <select id="event_date_day" class="col-md-2" name="event_date_day">
                @foreach(range(1, 31) as $day)
                <option {{old('event_date_day') == $day ? 'selected' : ''}}>{{$day}}</options>
                @endforeach
            </select>
            <select id="event_date_month" class="col-md-2" name="event_date_month">

            @foreach(range(1, 12) as $month)
                <option {{old('event_date_month') == $month ? 'selected' : ''}}>{{$month}}</options>
            @endforeach
            </select>
            <select id="event_date_year" class="col-md-2" name="event_date_year">

                @foreach(range(2016, 2026) as $year)
                    <option {{old('event_date_year') == $year ? 'selected' : ''}}>{{$year}}</options>
                @endforeach
            </select>
        </div>
        <br>
        <button class="btn btn-primary" type="submit">Add ticket</button>

    </form>
    @endsection