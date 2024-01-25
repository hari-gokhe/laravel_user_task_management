@extends('users.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-8">

        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Edit User
                </div>
                <div class="float-end">
                    <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="post">
                    @csrf
                    @method("PUT")

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                     <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user->email }}">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>

                     <div class="mb-3 row">
                        <label for="password" class="col-md-4 col-form-label text-md-end text-start">Password (Leave blank to keep current password )</label>
                        <div class="col-md-6">
                          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Roles</label>
                        <div class="col-md-6">
                          <select class="form-control @error('roles') is-invalid @enderror" multiple id="roles" name="roles[]"  >
                              @foreach($roles as $role)
                              <option value="{{ $role->id }}"
                               @if(in_array($role->id, $user->roles->pluck('id')->toArray()))
                                selected 
                                @endif  > {{ $role->name }} </option>
                              @endforeach  
                          </select>
                            @if ($errors->has('roles'))
                                <span class="text-danger">{{ $errors->first('roles') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>
    
@endsection