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
                                  <h3 class="mb-0">list status pengiriman</h3>
                                  <!-- <p class="text-sm mb-0">
                                    This is an exmaple of datatable using the well known datatables.net plugin. This is a minimal setup in order to get started fast.
                                  </p> -->
                                </div>
                                <div class="card-body">
                                <div class="table-responsive py-4">
                                  <table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>tgl</th>
                                            <th>kode</th>
                                            <th>nama</th>
                                            <th>nomor</th>
                                            <th>email</th>
                                            <th>alamat</th>
                                            <th>opsi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>tgl</th>
                                        <th>kode</th>
                                            <th>nama</th>
                                            <th>nomor</th>
                                            <th>email</th>
                                            <th>alamat</th>
                                            <th>opsi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @if(count($data)>0)
                                        @foreach ($data as $data)
                                        <tr>
                                            <td>{{$data->created_at}}</td>
                                            <td>{{$data->code}}</td>
                                            <td>{{$data->nama}}</td>
                                            <td>{{$data->alamat}}</td>
                                            <td>{{$data->nomor}}</td>
                                            <td>{{$data->email}}</td>
                                        
                                        <td style="text-align: center;">
                                        <a href="{{url('statusdetail/'.$data->code)}}">
                                        <button class="btn btn-success" style="margin: 5px;" onclick="approval('{{$data->code}}')"> lihat status</button>
                                        </a>
                                               </td>

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
     $('#tabel-data').DataTable({
        "order": [[ 0, "desc" ]]
    });
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
