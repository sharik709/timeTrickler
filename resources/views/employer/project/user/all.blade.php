@extends('employer.layouts.app')
@section('content')
    <project-user-all
            :project="{{ json_encode($project) }}"
            :users="{{ json_encode($users) }}"
        ></project-user-all>
@endsection
