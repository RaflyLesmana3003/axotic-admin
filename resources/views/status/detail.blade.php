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
                                  <h3 class="mb-0">detail status - {{$code}}</h3>
                                  <input type="hidden" name="code" id="code" value="{{$code}}">
                                  <!-- <p class="text-sm mb-0">
                                    This is an exmaple of datatable using the well known datatables.net plugin. This is a minimal setup in order to get started fast.
                                  </p> -->
                                </div>
                                <div class="card-body">
                                    @foreach($penjualan as $penjualans)
                                    <span>nama : <b>{{$penjualans->nama}}</b></span><br>
                                    <span>alamat : <b>{{$penjualans->alamat}}</b></span><br>
                                    <span>nomor : <b>{{$penjualans->nomor}}</b></span><br>
                                    <span>product : <b><br>
                                    @foreach($product as $products)
                                    <span>- {{$products->nama}} ({{$products->kode}})</span><br>
                                    @endforeach
                                    </b>
                                    </span><br>
                                @endforeach
                                <div class="table-responsive py-4">

                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        
                                    </div>
                                    <div class="table-data__tool-right">
                                    <a href="{{url('resi/'.$code)}}"><button class="btn btn-light" style="margin: 5px;"> resi</button></a>
                                    <a href="{{url('statustambah/'.$code)}}"><button class="btn btn-success" style="margin: 5px;"> tambah status</button></a>
                                    </div>
                                </div>

                                  <table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>tanggal</th>
                                            <th>status</th>
                                            <th>deskripsi</th>
                                            <th>opsi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>tanggal</th>
                                            <th>status</th>
                                            <th>deskripsi</th>
                                            <th>opsi</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @if(count($data)>0)
                                        @foreach ($data as $data)
                                        <tr>
                                            <td>{{$data->created_at}}</td>
                                            <td>{{$data->status}}</td>
                                            <td>{{$data->deskripsi}}</td>
                                        
                                        <td style="text-align: center;"><button class="btn btn-danger" style="margin: 5px;" onclick="hapus({{$data->id}})"> hapus</button>
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
    <script src="{{ url('vendor/jquery-3.2.1.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
     $('#tabel-data').DataTable();
} );

    function hapus(id) {
          var formData = new FormData();

        formData.append("id",id);
        formData.append("code",$('#code').val());

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
        url: "/statusdelete",
        data:formData,
        success:function(data){
            window.location.href = "{{url('/statusdetail')}}/"+data;

         
        },
          error: function(file, response)
          {

         
          }

        });
    }

</script>
@endsection
