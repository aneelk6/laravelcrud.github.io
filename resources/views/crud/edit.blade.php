<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=Larac, initial-scale=1.0">
    <title>Laravel Crud</title>
    <link rel="stylesheet" href="{{ asset('/assets/bootstrap.css') }}">
</head>
<body>
    <div class="container">
    <br>
        <div class="row">
            <div class="col-sm-4 offset-sm-4">
         
            @if(Session::get('fail'))
                <span class="alert alert-danger">{{ Session::get('fail') }}</span>
            @endif

            <form action="{{ route('PostResources.update',$post) }}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $post->id }}">
                <div class="card">
                        <div class="card-header">
                            Edit Post
                            <a class="btn btn-primary float-right" href="{{ url('PostResources') }}"> Back</a>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" value="{{ $post->name }}" class="form-control" name="name" placeholder="Ex. Jason Stathum" />
                                <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" value="{{ $post->email }}" class="form-control" name="email" placeholder="Ex. jason@example.com" />
                                <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="name">Mobile</label>
                                <input type="number" value="{{ $post->mobile }}" class="form-control" name="mobile" placeholder="Ex. 03xxxxxxxxx" />
                                <span class="text-danger">@error('mobile') {{ $message }} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="post">Post</label>
                                <textarea name="post" id="" cols="30" rows="5" class="form-control" placeholder="Say Something sweet...">{{{ $post->post }}}</textarea>
                                <span class="text-danger">@error('post') {{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="card-footer">
                        <button class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</body>
</html>