@extends('employer.layouts.app')
@section('content')
    <View-Project :project="{{ json_encode($project) }}"></View-Project>
@endsection
