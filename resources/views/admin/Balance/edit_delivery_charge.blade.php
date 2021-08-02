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
                    <form role="form" method="post" action="{{route('deliverychargeupdate')}}" enctype="multipart/form-data">
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
                                    <option value="+880" {{($edit_price->country_code=='+880') ? 'selected' : ''}}>Bangladesh</option>
                                    <option value="+91" {{($edit_price->country_code=='+91') ? 'selected' : ''}}>India</option>
                                    <option value="+92" {{($edit_price->country_code=='+92') ? 'selected' : ''}}>Pakistan</option>
                                    <option value="+65" {{($edit_price->country_code=='+65') ? 'selected' : ''}}>Singapore</option>
                                </select>

                            </div>
                           
                            <div class="form-group">
                                <label for="exampleInputEmail1">Min Weight</label>
                                <input type="number" name="min_weight" value="{{ $edit_price->min_weight }}" class="form-control" required php
                                    id="exampleInputEmail1" placeholder="Weight 0KG.">
                                    <input type="hidden" name="price_id" value="{{ $edit_price->id }}" class="form-control" required php
                                    id="exampleInputEmail1" >
                            </div> 
                            <div class="form-group">
                                <label for="exampleInputEmail1">Max Weight</label>
                                <input type="number" name="max_weight" value="{{ $edit_price->max_weight }}" class="form-control" required php
                                    id="exampleInputEmail1" placeholder="Weight 1KG.">
                            </div>

                         <div class="form-group">
                                <label for="exampleInputEmail1">Set Price</label>
                                <input type="number" name="set_price" class="form-control" value="{{ $edit_price->set_price }}"  required php
                                    id="exampleInputEmail1" placeholder="set price  ...">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Defualt Price</label>
                                <input type="number" name="default_price" class="form-control"value="{{ $edit_price->default_price }}"  required php
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