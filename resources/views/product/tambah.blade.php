@extends('layouts.app')

@section('content')
<!-- PAGE CONTAINER-->
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>tambah</strong> Produk
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" id="form" enctype="multipart/form-data" class="form-horizontal">
                                            <div class="row form-group">                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">nama</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="nama" placeholder="contoh: axolotl melanoid" class="form-control">
                                                    <!-- <small class="form-text text-muted">This is a help text</small> -->
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">harga</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text"  id="harga" placeholder="contoh: 150000" class="form-control">
                                                    <!-- <small class="form-text text-muted">This is a help text</small> -->
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">kode</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="kode" placeholder="contoh: a-647" class="form-control">
                                                    <!-- <small class="form-text text-muted">This is a help text</small> -->
                                                </div>
                                            </div>                                            
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="textarea-input" class=" form-control-label">deskripsi</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <div class="focused" data-toggle="quill" id="desc"  data-quill-placeholder="pada hari minggu itu"></div>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="file-input" class=" form-control-label">upload foto utama</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="file" id="file-input" name="file-input" class="form-control-file">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="file-input" class=" form-control-label">upload foto 2</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="file" id="file-input" name="file-input" class="form-control-file">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="file-input" class=" form-control-label">upload foto 3</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="file" id="file-input" name="file-input" class="form-control-file">
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
    <script src="vendor/jquery-3.2.1.min.js"></script>
<script src="//cdn.quilljs.com/1.3.6/quill.core.js"></script>
<script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script type="text/javascript">

    var $quill = new Quill('[data-toggle="quill"]', {
    modules: {
      toolbar: [
            ['bold', 'italic'],
            ['link', 'blockquote'],
            [{
              'list': 'ordered'
            }, {
              'list': 'bullet'
            }]
          ]
    },
    placeholder: 'silahkan berkarya disini',
    theme: 'snow'
});

    $("#form").submit(function(e) {
        tambahbenefit();
    e.preventDefault();
});
    function tambahbenefit() {
        var content;
        var delta = $quill.getContents();
        console.log(delta);
        content = JSON.stringify(delta);

       var formData = new FormData();

        formData.append("nama",$('#nama').val());
        formData.append("harga",$('#harga').val());
        formData.append("kode",$('#kode').val());
        formData.append("deskripsi",content);
        formData.append('photo', $('input[type=file]')[0].files[0]);
        formData.append('photo1', $('input[type=file]')[1].files[0]);
        formData.append('photo2', $('input[type=file]')[2].files[0]);

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
        url: "/produkstore",
        data:formData,
        success:function(data){
         window.location.href = '{{url('/listproduct')}}';
        },
          error: function(file, response)
          {

         
          }

        });

    };
</script>
@endsection
