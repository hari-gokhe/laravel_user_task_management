@extends('tasks.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-12">

        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">Task List</div>
            <div class="card-body">
                <a href="{{ route('tasks.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Task</a>
                 <a href="{{ route('logout') }}" class="btn btn-success btn-sm my-2"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                 <input type="text" placeholder="search task" class="form-control mb-3" name="search" onblur="searchData(this.value)">
                <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">S#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Discription</th>
                        <th scope="col">Due Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($tasks as $task)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{{ $task->due_date }}</td>
                            <td>{{ $task->status }}</td>
                            <td>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>

                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>   

                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this task?');"><i class="bi bi-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <td colspan="6">
                                <span class="text-danger">
                                    <strong>No Task Found!</strong>
                                </span>
                            </td>
                        @endforelse
                    </tbody>
                  </table>

                  {{ $tasks->links() }}

            </div>
        </div>
    </div>    
</div>
<script type="text/javascript">
    function searchData(searchText) {
        window.location.href = "http://127.0.0.1:8000/tasks?search="+searchText;
    }
</script>
@endsection
