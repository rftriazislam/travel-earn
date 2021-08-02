@extends('admin.dashboard')
@section('title')
    Admin || Add Delivery Charge
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">price</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('deliverychargesave')}}" enctype="multipart/form-data">
                        @if(session('message'))
                        <p style="color:aqua;" class="text-center">
                            {{session('message')}}
                        </p>
                        @endif
                        @foreach($errors->all() as $error)
                        <p style="color:red;" class="text-center">
                            {{$error}}
                        </p>
                        @endforeach

                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Country Name</label>
                                <select name="country_code"
                                    class="form-control @error('country_code') is-invalid @enderror" required>
                                    <option value="+880">Bangladesh</option>
                                    <option value="+91">India</option>
                                    <option value="+92">Pakistan</option>
                                    <option value="+65">Singapore</option>
                                </select>

                            </div>
                            {{-- <div class="form-group">
                                <label for="exampleInputEmail1">Country Name</label>
                                <select name="currency"
                                    class="form-control @error('country_code') is-invalid @enderror" required>
                                    <option value="Taka">Taka</option>
                                    <option value="rupee">rupee</option>
                                    <option value="rupee">rupee</option>
                                    <option value="SGD">SGD</option>
                                </select>

                            </div> --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Min Weight</label>
                                <input type="number" name="min_weight" class="form-control" required php
                                    id="exampleInputEmail1" placeholder="Weight 0KG.">
                            </div> 
                            <div class="form-group">
                                <label for="exampleInputEmail1">Max Weight</label>
                                <input type="number" name="max_weight" class="form-control" required php
                                    id="exampleInputEmail1" placeholder="Weight 1KG.">
                            </div>

                         <div class="form-group">
                                <label for="exampleInputEmail1">Set Price</label>
                                <input type="number" name="set_price" class="form-control" required php
                                    id="exampleInputEmail1" placeholder="set price  ...">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Defualt Price</label>
                                <input type="number" name="default_price" class="form-control" required php
                                    id="exampleInputEmail1" placeholder="Default price...">
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->


            </div>
            <!--/.col (left) -->
       
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection