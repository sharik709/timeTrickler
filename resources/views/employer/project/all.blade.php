@extends('employer.layouts.app')
@section('content')
    <div class="container mt-3">

        <div class="mb-5">
            <div class="d-flex justify-content-between">
                <h3>Projects</h3>
                <div>
                    <a href="/employer/project/create" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Project 
                    </a>
                </div>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Created On</th>
                    <th>Name</th>
                    <th>Users</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse( $projects as $project )
                    <tr>
                        <td>{{ $project->created_at->diffForHumans() }}</td>
                        <td>{{ $project->title }}</td>
                        <td>
                            <div class="usersList">
                                @foreach($project->users as $user) 
                                    <div class="userList-user">
                                        <img width="24px" height="24px" src="{{ $user->avatar }}" alt="{{ $user->name }}">
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td>
                            <a href="/employer/project/{{$project->uuid}}" class="btn btn-text" title="View Project">
                                <i class="far fa-eye" ></i>
                            </a>
                            <a href="/employer/project/{{ $project->uuid }}/user" class="btn btn-text" title="View users">
                                <i class="fas fa-users"></i>
                            </a>
                            <a href="/employer/project/{{ $project->uuid}}/setting" class="btn btn-text" title="Project settings">
                                <i class="fas fa-cog"></i>
                            </a>
                            <button type="submit" form="delete{{$project->uuid}}" class="btn btn-text" title="Delete project">
                                <i class="fas fa-trash"></i>
                            </button>
                            <form id="delete{{$project->uuid}}" action="/employer/project/{{ $project->uuid }}" method="POST">
                                <input type="hidden" value="DELETE" name="_method" />
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            No Projects were found <a href="/employer/project/create">Create new project</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="text-right">
         {{$projects->links()}}
        </div>
    </div>
@endsection
