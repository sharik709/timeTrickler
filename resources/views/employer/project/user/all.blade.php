@extends('employer.layouts.app')
@section('content')
    <div class="container ">
        <div class="d-flex justify-content-between mt-3 mb-4">
            <button type="button" onclick="window.history.back()" class="btn btn-outline-info">
                Go Back
            </button>
        </div>

        <div class="d-flex justify-content-between mb-2">
            <h3>Project Users</h3>

            <a href="/employer/project/{{$project->uuid}}/user/create">
                <i class="fas fa-plus"></i> Add User
            </a>
        </div>

        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email Address</th>
                        <th>Total Hours</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                
                    @forelse($project->users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img width="28px" height="28px" src="{{ $user->avatar }}" alt="">
                                    <span class="ml-2">
                                        {{ $user->name }}
                                    </span>
                                </div>
                            
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ rand(9, 100) }}</td>
                            <td>
                                <a class="btn btn-text" href="/employer/project/{{$project->uuid}}/user/{{$user->uuid}}">
                                    <i class="far fa-eye"></i>
                                </a>
                                <button type="submit" form="deleteUser{{$user->uuid}}" class="btn btn-text">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <form id="deleteUser{{$user->uuid}}" action="/employer/project/{{$project->uuid}}/user/{{$user->uuid}}" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                No Users were found <a href="/project/{{$project->uuid}}/user/create">Add new user</a>
                            </td>
                        </tr>
                    @endforelse
                
                
                </tbody>
            </table>
        </div>








    </div>

@endsection
