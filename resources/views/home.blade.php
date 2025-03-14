<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="fw-bold">To-Do List: {{ Auth::user()->name }}</h2>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Log Out</button>
                    </form>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <form class="d-flex mb-4" method="POST" action="{{ route('posts.store') }}">
                            @csrf
                            <input type="text" name="title" class="form-control me-2" placeholder="Enter a task here" required>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-plus"></i>
                            </button>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-hover text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col" class="text-start">Todo Item</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Created at</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $index => $post)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td class="text-start" style="max-width: 200px; white-space: normal; word-wrap: break-word;">
                                                {{ $post->title }}
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $post->status === 'Completed' ? 'success' : 'warning' }}">
                                                    {{ $post->status }}
                                                </span>
                                            </td>
                                            <td>
                                                {{ $post->created_at->diffForHumans() }}
                                            </td>
                                            <td>
                                                <!-- Tombol Toggle Status -->
                                                <form method="POST" action="{{ route('posts.toggleStatus', $post->id) }}" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <i class="bi {{ $post->status === 'In Progress' ? 'bi-check-lg' : 'bi-hourglass' }}"></i>
                                                    </button>
                                                </form>

                                                <!-- Tombol Edit -->
                                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editPostModal-{{ $post->id }}">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>

                                                <!-- Tampilan Modal Edit -->
                                                <div class="modal fade" id="editPostModal-{{ $post->id }}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit To-Do</h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="{{ route('posts.update', $post->id) }}">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="form-group mb-3">
                                                                        <label for="editPostTitle">Title</label>
                                                                        <input type="text" class="form-control" name="title" value="{{ $post->title }}" required>
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <label for="status">Status</label>
                                                                        <select class="form-control" name="status" required>
                                                                            <option value="In Progress" {{ $post->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                                            <option value="Completed" {{ $post->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                                        </select>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Tombol Hapus -->
                                                <form method="POST" action="{{ route('posts.destroy', $post->id) }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
