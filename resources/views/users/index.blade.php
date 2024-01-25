@extends('users.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-12">

        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">Users List</div>
            <div class="card-body">
                <a href="{{ route('users.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New User</a>
                <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">S#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Roles</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                
                              @foreach($user->roles as $role)
                                    {{ $role->name}} {{ !$loop->last ? ', ' : '' }}
                                @endforeach 

                            </td>
                            <td>
                                <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>

                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>   

                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this user?');"><i class="bi bi-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <td colspan="6">
                                <span class="text-danger">
                                    <strong>No User Found!</strong>
                                </span>
                            </td>
                        @endforelse
                    </tbody>
                  </table>

                  

            </div>
        </div>
    </div>    
</div>
    
@endsection
