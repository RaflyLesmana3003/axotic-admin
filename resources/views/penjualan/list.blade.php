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
                                  <h3 class="mb-0">list penjualan</h3>
                                  <!-- <p class="text-sm mb-0">
                                    This is an exmaple of datatable using the well known datatables.net plugin. This is a minimal setup in order to get started fast.
                                  </p> -->
                                </div>
                                <div class="card-body">
                                <div class="table-responsive py-4">
                                  <table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>kode</th>
                                            <th>nama</th>
                                            <th>alamat</th>
                                            <th>status</th>
                                            <th>total</th>
                                            <th>bukti pembayaran</th>
                                            <th>opsi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>kode</th>
                                            <th>nama</th>
                                            <th>alamat</th>
                                            <th>status</th>
                                            <th>total</th>
                                            <th>bukti pembayaran</th>
                                            <th>opsi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @if(count($data)>0)
                                        @foreach ($data as $data)
                                        <tr>
                                            <td>{{$data->code}}</td>
                                            <td>{{$data->nama}}</td>
                                            <td>{{$data->alamat}}</td>
                                            @if($data->status == 0)                               
                                            <td> <span class="badge badge-dark" style="color:white;" >belum mengirim bukti pembayaran</span></li>
                                            @endif
                                            @if($data->status == 1)                               
                                            <td> <span class="badge badge-warning" style="color:white;" >menunggu approval</span></td>
                                            @endif
                                            @if($data->status == 2)                               
                                            <td> <span class="badge badge-success" style="color:white;" >pembayaran diterima</span></td>
                                            @endif
                                            @if($data->status == 3)                               
                                            <td> <span class="badge badge-danger" style="color:white;" >pembayaran ditolak</span></td>
                                            @endif
                                            <td>{{$data->total}}</td>
                                        @if($data->buktipembayaran != null)
                                            <td style="text-align: center;"><img class=" img-fluid rounded" width="150px" src="http://127.0.0.1:8001/storage/file/{{$data->buktipembayaran}}" ></td>
                                        @else
                                        <td style="text-align: center;">belum mengirim bukti pembayaran</td>

                                        @endif
                                        <td style="text-align: center;"><button class="btn btn-success" style="margin: 5px;" onclick="approval('{{$data->code}}')"> approval</button>
                                                <a onclick="deletea('{{$data->code}}')"><button class="btn btn-warning" href=""> tolak</button></a></td>

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
        url: "/penjualandelete",
        data:formData,
        success:function(data){
            window.location.href = '{{url('/listpenjualan')}}';
         
        },
          error: function(file, response)
          {

         
          }

        });
    }

    function approval(id) {
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
        url: "/penjualanapproval",
        data:formData,
        success:function(data){
            window.location.href = '{{url('/listpenjualan')}}';
         
        },
          error: function(file, response)
          {

         
          }

        });
    }
</script>
@endsection
