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
                                        <strong>tambah</strong> Produk
                                    </div>
                                    @if(count($product)>0)
                                    @foreach ($product as $product)
                                    <div class="card-body card-block">
                                        <form action="" method="post" id="form" enctype="multipart/form-data" class="form-horizontal">
                                            <div class="row form-group">                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <input type="hidden" id="id" value="{{$product->id}}">

                                                    <label for="text-input" class=" form-control-label">nama</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="nama" placeholder="contoh: axolotl melanoid" value="{{$product->nama}}" class="form-control">
                                                    <!-- <small class="form-text text-muted">This is a help text</small> -->
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">harga</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text"  id="harga" placeholder="contoh: 150000" value="{{$product->harga}}" class="form-control">
                                                    <!-- <small class="form-text text-muted">This is a help text</small> -->
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">kode</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="kode" placeholder="contoh: a-647" value="{{$product->kode}}" class="form-control">
                                                    <!-- <small class="form-text text-muted">This is a help text</small> -->
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">stok</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label class="switch switch-3d switch-success mr-3">
                                                    @if($product->stok == 1)
                                                      <input type="checkbox" id="stok" class="switch-input" checked>
                                                      <span class="switch-label"></span>
                                                      <span class="switch-handle"></span>
                                                    @else
                                                      <input type="checkbox" id="stok" class="switch-input" >
                                                      <span class="switch-label"></span>
                                                      <span class="switch-handle"></span>
                                                    @endif
                                                      
                                                    </label>
                                                </div>
                                            </div>
                                            
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                   
                                                    <label for="textarea-input"  class=" form-control-label">deskripsi</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <div class="focused" data-toggle="quill" id="desc"  data-quill-placeholder="pada hari minggu itu"></div>
                                                    <script src="//cdn.quilljs.com/1.3.6/quill.core.js"></script>
                                                    <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
                                                    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
                                                    <script>

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
                                                        $quill.setContents(<?php echo $product->desc; ?>);
                                                    </script>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                        </form>
                                    </div>

                                    @endforeach
                                    @endif
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
         var content;
        var delta = $quill.getContents();
        console.log(delta);
        content = JSON.stringify(delta);
        var stok = 1;

            if($("#stok").is(":checked")){

                stok = 1;

            }

            else if($("#stok").is(":not(:checked)")){

                stok = 0;
                

            }
       var formData = new FormData();

        formData.append("id",$('#id').val());
        formData.append("nama",$('#nama').val());
        formData.append("harga",$('#harga').val());
        formData.append("kode",$('#kode').val());
        formData.append("stok",stok);
        formData.append("deskripsi",content);

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
        url: "/produkupdate",
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
