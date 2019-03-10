@extends('employer.layouts.app')
@section('content')
    <project :project-data="{{ json_encode($projects) }}"></project>
@endsection
