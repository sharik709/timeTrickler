@extends('layouts.app')
@section('content')
    @foreach( $projects as $project )

        <h3>{{ $project->title }}</h3>
        <p>{{ $project->description }}</p>
    @endforeach
@endsection
