@extends('tasks.layouts')

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
                    Edit Task
                </div>
                <div class="float-end">
                    <a href="{{ route('tasks.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('tasks.update', $task->id) }}" method="post">
                    @csrf
                    @method("PUT")

                    <div class="mb-3 row">
                        <label for="title" class="col-md-4 col-form-label text-md-end text-start">Title</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $task->title }}">
                            @if ($errors->has('title'))
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="description" class="col-md-4 col-form-label text-md-end text-start">Description</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ $task->description }}">
                            @if ($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="due_date" class="col-md-4 col-form-label text-md-end text-start">Due Date</label>
                        <div class="col-md-6">
                          <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date" value="{{ $task->due_date }}">
                            @if ($errors->has('due_date'))
                                <span class="text-danger">{{ $errors->first('due_date') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="status" class="col-md-4 col-form-label text-md-end text-start">Status</label>
                        <div class="col-md-6">
                          <select class="form-control @error('status') is-invalid @enderror" id="price" name="status" value="{{ $task->status }}">
                            <option value="In Progress"  {{ $task->status =="In Progress" ? "selected" : "" }}>In Progress</option>
                            <option value="Completed" {{ $task->status =="Completed" ? "selected" : "" }}>Completed</option>
                            <option value="Pending" {{ $task->status =='Pending' ? "selected" : "" }}>Pending</option>
                          </select>
                            @if ($errors->has('status'))
                                <span class="text-danger">{{ $errors->first('status') }}</span>
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