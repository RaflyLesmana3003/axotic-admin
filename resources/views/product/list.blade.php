@extends('layouts.app')

@section('content')
<!-- PAGE CONTAINER-->
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                              <div class="card">
                                <!-- Card header -->
                                <div class="card-header">
                                  <h3 class="mb-0">list produk</h3>
                                  <!-- <p class="text-sm mb-0">
                                    This is an exmaple of datatable using the well known datatables.net plugin. This is a minimal setup in order to get started fast.
                                  </p> -->
                                </div>
                                <div class="card-body">
                                <div class="table-responsive py-4">
                                  <table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>nama</th>
                                            <th>kode</th>
                                            <th>stok</th>
                                            <th>harga</th>
                                            <th>foto</th>
                                            <th>opsi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>nama</th>
                                            <th>kode</th>
                                            <th>stok</th>
                                            <th>harga</th>
                                            <th>foto</th>
                                            <th>opsi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @if(count($data)>0)
                                        @foreach ($data as $data)
                                        <tr>
                                            <td>{{$data->nama}}</td>
                                            <td>{{$data->kode}}</td>
                                            <td>
                                                @if($data->stok == 1)
                                               <span class="status--process">{{"tersedia"}}</span>                                                
                                               @else
                                               <span class="status--denied">{{"kosong"}}</span>
                                               @endif
                                            </td>
                                            <td>{{$data->harga}}</td>
                                            <td style="text-align: center;"><img class=" img-fluid rounded" width="150px" src="{{ asset('storage/file/'.$data->photo) }}"></td>
                                            <td style="text-align: center;"><button class="btn btn-danger" style="margin: 5px;" onclick="deletea({{$data->id}})"> delete</button>
                                                <a href="{{url('updateproduct/'.$data->id)}}"><button class="btn btn-warning" href=""> update</button></a></td>

                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                </div>
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

<script type="text/javascript">
    $(document).ready(function() {
     $('#tabel-data').DataTable();
} );

    function deletea(id) {
          var formData = new FormData();

        formData.append("id",id);

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
        url: "/produkdelete",
        data:formData,
        success:function(data){
            window.location.href = '{{url('/listproduct')}}';
         
        },
          error: function(file, response)
          {

         
          }

        });
    }
</script>
@endsection
