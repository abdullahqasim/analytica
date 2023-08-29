@extends('layout.base')
@section('container')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Task CRUD</h2>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('task.create') }}"> Create Task</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->title }}</td>
                    <td>{{ $data->description }}</td>
                    <td>{{ $data->status }}</td>
                    <td>
                        <form action="{{ route('task.destroy',$data->id) }}" method="Post">
                            <a class="btn btn-primary" href="{{ route('task.edit',$data->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>
    <div>

        {!! $tasks->links("pagination::bootstrap-4") !!}
    </div>
</div>
@endsection()
