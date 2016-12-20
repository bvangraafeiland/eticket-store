<!DOCTYPE html>
<html lang="en">
<head>
    <link href="/css/app.css" rel="stylesheet">
    <style>
        .barcode {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body style="margin-top: 20px;">
<div class="container">
    <div class="barcode">
    {!!$barcode!!}
    </div>
    <div class="jumbotron">
        <h1>{{$ticket->title}}</h1>
        <p>{{$ticket->location}}</p>
        <p>{{$ticket->event_date->toDayDateTimeString()}}</p>
    </div>
</div>
</body>
</html>
