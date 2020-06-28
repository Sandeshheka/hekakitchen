@extends('admin.adminLayouts')

@section('admin_content')

 <div class="sl-mainpanel">
     

      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5> Post List</h5>
         
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Post List
  <a href="{{ route('add.blogPost') }}" class="btn btn-sm btn-warning" style="float: right;"  >Add New Post</a>
          </h6>
           

          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">Post Title</th>
                  <th class="wd-15p">Post Category</th>
                  <th class="wd-15p">Image </th>
                  <th class="wd-20p">Action</th>
                  
                </tr>
              </thead>
              <tbody>
                @foreach($blogPost as $b)
                <tr>
                  <td>{{ $b->post_title_en }}</td>
                  <td>{{ $b->category_name_en }}</td>
                  <td> <img src="{{ URL::to($b->post_image) }}" style="height: 50px; width: 50px;"> </td>
                  <td>
                    <a href="{{ URL::to('editBlogPost/'.$b->id) }} " class="btn btn-sm btn-info">Edit</a>
                    <a href="{{ URL::to('deleteBlogPost/'.$b->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                  </td>
                   
                </tr>
                @endforeach
                 
              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->

        

 
    </div><!-- sl-mainpanel -->

 

@endsection