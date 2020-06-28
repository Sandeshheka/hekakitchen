@extends('admin.adminLayouts')

@section('admin_content')
<div class="sl-mainpanel">


    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Product Table</h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Product List
                <a href="{{route('add.product')}}" class="btn btn-sm btn-success" style="float: right;">Add New</a>
            </h6>


            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-15p">ID</th>
                            <th class="wd-15p">Image</th>
                            <th class="wd-15p">Product Name</th>
                            <th class="wd-15p">Product Code</th>
                            <th class="wd-15p">Quantity</th>
                            <th class="wd-15p">Category</th>
                            <th class="wd-15p">Brand</th>
                            <th class="wd-15p">Status</th>
                     
              
                            <th class="wd-20p">Action</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach($product as $key=>$p)
                        <tr>
                            <td>{{$key +1}}</td>
                            <td><img src="{{URL::to($p->image_one)}}" height="50px;" width="50px;" alt=""></td>
                            <td>{{$p->product_name}}</td>
                            <td>{{$p->product_code}}</td>
                            <td>{{$p->product_quantity}}</td>
                           
                            <td>{{$p->category_name}}</td>
                            <td>{{$p->brand_name}}</td>
                            <td>
                                @if($p->status == 1)
                                <span class="badge badge-success">Active</span>

                                @else
                                <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            
                            <td>
                                <a href="{{URL::to('/editProduct/'.$p->id)}}" class="btn btn-sm btn-info"title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="{{URL::to('/deleteProduct/'.$p->id)}}" class="btn btn-sm btn-danger" title="Delete" id="delete"><i class="fa fa-trash"></i></a>
                                <a href="{{URL::to('/viewProduct/'.$p->id)}}" class="btn btn-sm btn-warning" title="Show"><i class="fa fa-eye"></i></a>
                                @if($p->status == 1)
                                <a href="{{URL::to('/inactiveProduct/'.$p->id)}}" class="btn btn-sm btn-danger" title="Inactive"><i class="fa fa-thumbs-down" ></i></a>
                                @else
                                <a href="{{URL::to('/activeProduct/'.$p->id)}}" class="btn btn-sm btn-info" title="Active"><i class="fa fa-thumbs-up" ></i></a>
                                @endif
                            </td>


                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div><!-- table-wrapper -->
        </div><!-- card -->




    </div><!-- sl-mainpanel -->
    
    @endsection