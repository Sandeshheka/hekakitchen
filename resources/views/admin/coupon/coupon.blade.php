@extends('admin.adminLayouts')

@section('admin_content')
<div class="sl-mainpanel">


    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Coupon Table</h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Coupon List
                <a href="" class="btn btn-sm btn-success" style="float: right;" data-toggle="modal" data-target="#modaldemo3">Add New</a>
            </h6>


            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-15p">ID</th>
                            <th class="wd-15p">Coupon Code</th>
                            <th class="wd-15p">Coupon Percentage</th>
                            <th class="wd-20p">Action</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach($coupons as $key=>$c)
                        <tr>
                            <td>{{$key +1}}</td>
                            <td>{{$c->coupon}}</td>
                            <td>{{$c->discount}}%</td>
                            <td>
                                <a href="{{URL::to('/editCoupon/'.$c->id)}}" > <button class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button></a>
                                <a href="{{URL::to('/deleteCoupon/'.$c->id)}}" id="delete"><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a>
                            </td>


                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div><!-- table-wrapper -->
        </div><!-- card -->




    </div><!-- sl-mainpanel -->
    <!-- LARGE MODAL -->
    <div id="modaldemo3" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Brand Add</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>

                @endif
                <div class="modal-body pd-20">
                    <form action="{{route('coupon.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="coupon">Coupon Code</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                             placeholder="Coupon Code" name="coupon">

                        </div>

                        <div class="form-group">
                            <label for="discount">Coupon Discount %</label>
                            <input type="text" class="form-control" aria-describedby="emailHelp"
                             placeholder=" Coupon Discount" name="discount">

                        </div>

                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info pd-x-20">submit</button>
                    <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div><!-- modal-dialog -->
    </div><!-- modal -->

    @endsection