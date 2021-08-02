@extends('admin.dashboard')
@section('content')



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Slider</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="{{route('slidersave')}}" enctype="multipart/form-data">
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
                                    <label for="exampleInputEmail1">Slider Name</label>
                                    <input type="text" name="slider_name" class="form-control" required php
                                        id="exampleInputEmail1" placeholder="Slider Name ...">
                                </div>
                                <div class="form-group">
                                    <label>Slider Title</label>
                                    <textarea class="textarea" rows="3" required name="slider_title"
                                    placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Slider Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" required name="slider_image"
                                                id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">slider
                                                Select</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="">Upload</span>
                                        </div>
                                    </div>
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
                <!-- right column -->
                <div class="col-md-6">



                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Slider Information</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if(session('delete_message'))
                            <p style="color:aqua;" class="text-center">
                                {{session('delete_message')}}
                            </p>
                            @endif
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>

                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Title</th>
                                        <th>Image</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($slider_info as $v_slider)
                                    <tr>

                                        <td>{{$v_slider->id}}</td>

                                        <td>{{$v_slider->slider_name}}</td>
                                        <td> <?php
                                            $pieces = explode(" ", $v_slider->slider_title);
                                          echo     implode(" ", array_splice($pieces, 0, 18)).'...'; 
                                   ?>
                                        </td>
                                        <td><img src="{{asset('back_end/slider_image')}}/{{$v_slider->slider_image}}"
                                                alt="Null" width="60" height="60"></td>


                                        <td>

                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                @if($v_slider->status==0)
                                                <button type="button" style=" color:white ;background-color:red"
                                                    class="btn ">
                                                    <a style="color:white"
                                                        href="{{url('/admin-slider-status')}}/{{$v_slider->status}}/{{$v_slider->id}}">OFF</a>
                                                </button>
                                                @else
                                                <button type="button" style=" color:white ;background-color:green"
                                                    class="btn ">
                                                    <a style="color:white"
                                                        href="{{url('/admin-slider-status')}}/{{$v_slider->status}}/{{$v_slider->id}}">ON</a>
                                                </button>
                                                @endif
                                                <button type="button" style=" color:white ;background-color:aqua"
                                                    class="btn "><a style="color:white"
                                                        href="{{url('/admin-slider-edit')}}/{{$v_slider->id}}">
                                                        Updated/Edit</a></button>
                                                <button type="button" style="color:white  ;background-color:red"
                                                    class="btn "><a style="color:white"
                                                        href="{{url('/admin-slider-delete')}}/{{$v_slider->id}}">
                                                        Delete</a></button>
                                            </div>

                                        </td>
                                    </tr>

                                    @empty
                                    <tr class='text-center' style="color:red">
                                        <td colspan="12">No available data</td>
                                    </tr>
                                    @endforelse

                                </tbody>

                                <tfoot>

                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->




@endsection