<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=Larac, initial-scale=1.0">
    <title>Laravel Crud</title>
    <link rel="stylesheet" href="assets/bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
</head>
<body>


<!-- Add post modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="PostResources" method="POST" enctype="multipart/form-data">
            @csrf

      <div class="modal-body">
      
                
                        
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Ex. Jason Stathum" />
                                <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Ex. jason@example.com" />
                                <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="name">Mobile</label>
                                <input type="number" class="form-control" name="mobile" placeholder="Ex. 03xxxxxxxxx" />
                                <span class="text-danger">@error('mobile') {{ $message }} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="post">Post</label>
                                <textarea name="post" id="" cols="30" rows="5" class="form-control" placeholder="Say Something sweet..."></textarea>
                                <span class="text-danger">@error('post') {{ $message }} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="image">Upload Image</label>
                                <input type="file" class="form-control" name="image"/>
                                <span class="text-danger">@error('image') {{ $message }} @enderror</span>
                            </div>
                        
                
                </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save data</button>
      </div>
      </form>
      </div>

    </div>
  </div>
</div>

<!-- Add post modal -->




    <div class="container">

    @if(Session::get('success'))
                <span class="alert alert-success">{{ Session::get('success') }}</span>
            @endif

            @if(Session::get('fail'))
                <span class="alert alert-danger">{{ Session::get('success') }}</span>
            @endif
            <!-- Button trigger modal -->
       




        <div class="row">
            <div class="col-sm-12">
            <h1 class="text-center">All Post Details</h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Add Post
        </button>
        <br>
        <br>
            <table id="datatable" class="table table-hovered table-stripped">
                    <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Post</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($post as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->mobile }}</td>
                            <td class="text-center">{{ $data->post }}</td>
                            <td>
                                <img src="image/{{ $data->image }}" alt="" width="70px" height="70px" style="border-radius:50%">
                            </td>
                            <td>
                           <div class="btn-group">
                            <a type="button" href="#" class="btn btn-primary edit">Edit</a>
                            &nbsp;
                            <form method="post" action="{{ route('PostResources.destroy',$data) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger delete-confirm" data-name="{{ $data->name }}" type="submit">Delete</button>
                            </form>
                           </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
            </table>
            </div>
    </div>


        <!-- Edit Modal Start-->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="demoModalLabel"> Edit Post</h5>
								<button type="button" class="close" data-dismiss="modal" aria- 
                                label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
						</div>
						<div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 offset-sm-12">
                        
                            @if(Session::get('fail'))
                                <span class="alert alert-danger">{{ Session::get('fail') }}</span>
                            @endif

                            <form action="PostResources" method="POST" id="editForm" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" id="id" value="">

                                        
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Ex. Jason Stathum" />
                                                <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Ex. jason@example.com" />
                                                <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Mobile</label>
                                                <input type="number" class="form-control" name="mobile" id="mobile" placeholder="Ex. 03xxxxxxxxx" />
                                                <span class="text-danger">@error('mobile') {{ $message }} @enderror</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="post">Post</label>
                                                <textarea name="post" id="post" cols="30" rows="5" class="form-control" placeholder="Say Something sweet..."></textarea>
                                                <span class="text-danger">@error('post') {{ $message }} @enderror</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="image">Update Image</label>
                                                <input type="file" class="form-control" name="image"/>
                                            </div>
                                        
                                        <div class="modal-footer">
							                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								            <button type="submit" class="btn btn-primary">Update</button>
						                </div>
                                    </div>
                            </form>
                            </div>
						</div>
					</div>
				</div>
			</div>
	    <!-- Edit Modal End-->



        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function(){
            var table = $('#datatable').DataTable();

            //Start Edit Record
            table.on('click', '.edit', function(){
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')){
                    $tr = $tr.prev('.parent');
                }
                
                var data = table.row($tr).data();
                console.log(data);
                // alert(data);

                $('#id').val(data[0]);
                $('#name').val(data[1]);
                $('#email').val(data[2]);
                $('#mobile').val(data[3]);
                $('#post').val(data[4]);

               $('#editForm').attr('action', 'PostResources/'+data[0]);
            //    alert(a);
            //    $('#id').val(a);
                $('#editModal').modal('show');
            })
        })



        $('.delete-confirm').click(function(event) {
      var form =  $(this).closest("form");
      var name = $(this).data("name");
      event.preventDefault();
      swal({
          title: `Are you sure you want to delete ${name}'s Post?`,
          text: "If you delete this, it will be gone forever.",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          form.submit();
        }
      });
  });


    </script>


    
</body>
</html>