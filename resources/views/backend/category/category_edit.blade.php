@extends('admin.admin_master')
@section('admin')


<div class="container-full">

    <!-- Main content -->
    <section class="content">
    <div class="row">


        <div class="col-12">

            <div class="box">
                <div class="box-header with-border">
                <h3 class="box-title">Edit Category</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        
                        <form method="POST" action="{{ route('category.update') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $category->id }}">
                        
                            <div class="form-group">
                                <h5>Category English<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="category_name_en" class="form-control" value="{{ $category->category_name_en }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Category Arabic <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="category_name_ar" class="form-control" value="{{ $category->category_name_ar }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Brand Icon <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="category_icon" class="form-control" value="{{ $category->category_icon }}">
                                </div>
                            </div>
                                    
                            
                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-rounded btn-primary mb-5">Update</button>
                            </div>
                        </form>    
                
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
    
                     
        </div>
        <!-- /.col -->

    </div>
    <!-- /.row -->
    </section>
    <!-- /.content -->

</div>

@endsection