@extends('layouts.app')

@section('content')
<script src="{{ url('vendor/jquery-3.2.1.min.js')}}"></script>

<!-- PAGE CONTAINER-->
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>tambah</strong> status - <strong>{{$code}}</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" id="form" enctype="multipart/form-data" class="form-horizontal">
                                            <div class="row form-group">                                            </div>
                                           
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">status</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="hidden"  id="code" value="{{$code}}" >
                                                    <input type="text"  id="status" placeholder="sedang packaging"  class="form-control" required>
                                                    <!-- <small class="form-text text-muted">This is a help text</small> -->
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">deskripsi</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="deskripsi" placeholder="ditunggu"  class="form-control">
                                                    <!-- <small class="form-text text-muted">This is a help text</small> -->
                                                </div>
                                            </div>
                                           
                                        </form>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" form="form" class="btn btn-primary btn-sm">
                                            Submit
                                        </button>   
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>
   

<script type="text/javascript">
       
    $("#form").submit(function(e) {
        //       
        tambahbenefit();
    e.preventDefault();
});
    function tambahbenefit() {
       
       var formData = new FormData();

        formData.append("code",$('#code').val());
        formData.append("status",$('#status').val());
        formData.append("deskripsi",$('#deskripsi').val());

        $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

        });



        $.ajax({

        type:'POST',
        processData: false,
    contentType: false,
        fileElementId: "customFile",
        url: "/addstatus",
        data:formData,
        success:function(data){
            window.location.href = "{{url('/statusdetail')}}/"+data;

         
        },
          error: function(file, response)
          {

         
          }

        });

    };
</script>
@endsection
