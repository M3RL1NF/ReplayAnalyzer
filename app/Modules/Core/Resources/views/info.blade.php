@extends('layouts.app')

@section('content')
    <b-container>
        <h2>Info</h2>

        <h4>General</h4>

        <p>
            Players of the online game <a href="https://eu.wargaming.net/en/games/wot" style="color: white;"><u> World of Tanks</u></a> have the opportunity to fight battles on different maps with different season, vegetation and terrain types. 
            The maps are designed to ensure fair and balanced competition. However, the game experience often suggests a different reality. 
            World of Tanks Maps is supposed to reveal the actual reality based on automatically evaluated replays. 
        </p>

        <h4>Content</h4>

        <p>
            World of Tanks Maps collects and evaluates replay data from the official <a href="http://wotreplays.eu/" style="color: white;"><u> World of Tanks Replays</u></a> website.
            This makes it possible to get an exact overview of all uploaded replays without having to evaluate them manually. 
            Due to the high number of replays uploaded daily, average values can be determined with great accuracy. Only replays since patch 1.0.0 are considered.
        </p>

    </b-container>
@endsection
