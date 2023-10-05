@extends('admin.layouts.app');


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Blogs / List</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"> Home</a></li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content  h-100">
        <div class="container-fluid  h-100">
            <!-- Small boxes (Stat box) -->
            <div class="row">

                <div class="col-md-12 ">
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ session::get('success') }}</div>
                    @endif

                    @if (Session::has('error'))
                        <div class="alert alert-danger">{{ session::get('error') }}</div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <div class="card-tile">

                                <a href="{{ route('blog.create.form') }}" class="btn btn-primary">Create </a>


                            </div>
                            <div class="card-tools">
                                <form action="" method="get">
                                    <div class="input-group mb-0 mt-0" style="width:250px;">
                                        <input value="{{ !empty(Request::get('keyword')) ? Request::get('keyword') : '' }}"
                                            type="text" name="keyword" class="form-control float-right"
                                            placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"> </i>

                                            </button>

                                        </div>
                                    </div>
                                </form>
                            </div>


                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table">
                                <tr>

                                    <th width="50"> Id </th>
                                    <th width="50"> Image </th>
                                    <th> Name </th>
                                    <th width="100"> Created </th>
                                    <th width="100"> Status </th>

                                    <th width="100"> Edit </th>
                                    <th width="100"> Delete </th>
                                </tr>
                                @if (!@empty($blogs))
                                    @foreach ($blogs as $blog)
                                        <tr>

                                            <td> {{ $blog->id }}</td>
                                            <td>
                                                @if (!empty($blog->image))
                                                    <img src="{{ asset('/uploads/blogs/thumb/small/' . $blog->image) }}"
                                                        width="50">
                                                @else
                                                    <img src="{{ asset('/uploads/placeholder.png') }}" width="50">
                                                @endif
                                            </td>
                                            <td> {{ $blog->name }} </td>
                                            <td> {{ date('d/m/Y', strtotime($blog->created_at)) }} </td>

                                            <td>
                                                @if ($blog->status == 1)
                                                    <span class="badge bg-success"> Active </span>
                                                @else
                                                    <span class="badge bg-danger"> Block </span>
                                                @endif

                                            </td>

                                            <td>

                                                <a href="{{ route('blog.edit', $blog->id) }}"
                                                    class="btn btn-primary">
                                                    Edit</a>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);" class="btn btn-danger"
                                                    onclick="deleteBlog({{ $blog->id }});"> Delete </a>

                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">Records Not Found </td>

                                    </tr>
                                @endif

                            </table>


                        </div>

                    </div>


                </div>
                <div class="row">
                    @if (!@empty($blogs))
                        {{ $blogs->links('pagination::bootstrap-5') }}
                    @endif
                </div>
            </div>
        </div>
        <!-- /.row -->



        <!-- /.row (main row) -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->


@endsection

@section('extraJs')
    <script type="text/javascript">
        function deleteBlog(id) {
            if (confirm("Are you sure you want to delete? ")) {

                $.ajax({

                    url: '{{ url("admin/blogs/delete") }}/'+id,
                    type: 'POST',
                    dataType: 'json',
                    data: {},
                    success: function(response) {
                      window.location.href="{{route('bloglist')  }}";

                    }
                });

            }
        }
    </script>
@endsection
