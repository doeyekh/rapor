<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>
<div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3><?= $title; ?></h3>
                        </div>
                    </div>
                </div>
                <section class="section mt-4">
                    <div class="card">
                        <div class="card-header">
                        <button type="button" class="btn btn-primary btnAdd" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah
                        </button>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive datatable-minimal">
                                <table id="tabelData" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Jenjang</th>
                                            <th>Total Semester</th>
                                            <th>Level Kelas</th>
                                            <th>Kelas</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

<!-- modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-xxl-down">
    <div class="modal-content">
        <form class="" action="" id="formUser">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
            </div>
            <div class="modal-body">
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Jenjang</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Jenjang...">
                    <div class="errornama invalid-feedback"></div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="smt" class="col-sm-2 col-form-label">Total Semester</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="smt" name="smt" aria-describedby="basic-addon2" placeholder="Total Semester...">
                        <div class="errorsmt invalid-feedback"></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="level" class="col-sm-2 col-form-label">Total Level Kelas</label>
                    <div class="col-sm-10 col-md-2">
                        <input type="number" class="form-control" id="level" name="level"  placeholder="Total Semester...">
                        <div class="errorlevel invalid-feedback"></div>
                    </div>
                    <label for="awal" class="col-sm-1 col-form-label">Kelas Awal</label>
                    <div class="col-sm-10 col-md-2">
                        <input type="number" class="form-control" id="awal" name="awal"  placeholder="Kelas Awal..">
                        <div class="errorawal invalid-feedback"></div>
                    </div>
                    <label for="akhir" class="col-sm-1 col-form-label">Kelas Akhir</label>
                    <div class="col-sm-10 col-md-2">
                        <input type="number" class="form-control" id="akhir" name="akhir"  placeholder="Kelas Akhir..">
                        <div class="errorakhir invalid-feedback"></div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="idjenjang" class="idjenjang" value="">
                <input type="hidden" name="aksi" class="aksi" value="">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btnSave">Simpan</button>
            </div>
        </form>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
<?= $this->section('js'); ?>
<script>
    $(document).ready(function(){
        var tabel = $('#tabelData').DataTable({
            processing: true,
            serverSide: true,
            order: [], //this mean no init order on datatable
            ajax: '/admin/jenjanglevel',
            columns : [
                {data:'nomor',orderable:false},
                {data:'nama_jenjang',orderable:false},
                {data:'smt',orderable:false},
                {data:'level',orderable:false},
                {data:'kelas',orderable:false},
                {
                    data:'id_jenjang',
                    mRender : function(data,type,full){
                        return '<button id="'+data+'" type="button" class="btn btn-primary btnEdit" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-pencil-fill"></i></button>'
                    }
                },
            ]
        })
        $('.btnAdd').click(function(e){
            $('.modal-title').html('Tambah Data Jenjang')
            $('.btnSave').html('Simpan')
            $('.aksi').val('insert')
        })

        $(document).on('click','.btnEdit',function(){
            var id = $(this).attr('id');
            $('.modal-title').html('Edit Data Jenjang')
            $('.btnSave').html('Edit')
            $('.aksi').val('update')
            $('.idjenjang').val(id);
            $.ajax({
                url :'/admin/jenjang-level',
                data : {id:id,_method:'PUT'},
                dataType : 'json',
                method : 'post',
                success:function(data){
                    $('#nama').val(data.nama_jenjang)
                    $('#smt').val(data.total_smt)
                    $('#level').val(data.total_level)
                    $('#awal').val(data.kelas_awal)
                    $('#akhir').val(data.kelas_akhir)
                }
            })
        })

        $('#awal').keyup(function(){
            var data = parseInt($('#level').val()) + parseInt($('#awal').val()) - 1
            $('#akhir').val(data);
        })
        
        $(document).on('submit','#formUser',function(e){
            e.preventDefault();
            $.ajax({
                url : '/admin/jenjang-level',
                method : 'post',
                data : $(this).serialize(),
                dataType : 'json',
                success : function(respon){
                    console.log(respon)
                    if(respon.error){
                        if(respon.error.nama){
                            $('#nama').addClass('is-invalid')
                            $('.errornama').html(respon.error.nama)
                        }else{
                            $('#nama').removeClass('is-invalid')
                            $('.errornama').html()
                        }
                        if(respon.error.smt){
                            $('#smt').addClass('is-invalid')
                            $('.errorsmt').html(respon.error.smt)
                        }else{
                            $('#smt').removeClass('is-invalid')
                            $('.errorsmt').html()
                        }
                        if(respon.error.level){
                            $('#level').addClass('is-invalid')
                            $('.errorlevel').html(respon.error.level)
                        }else{
                            $('#level').removeClass('is-invalid')
                            $('.errorlevel').html()
                        }
                        if(respon.error.awal){
                            $('#awal').addClass('is-invalid')
                            $('.errorawal').html(respon.error.awal)
                        }else{
                            $('#awal').removeClass('is-invalid')
                            $('.errorawal').html()
                        }
                        if(respon.error.akhir){
                            $('#akhir').addClass('is-invalid')
                            $('.errorakhir').html(respon.error.akhir)
                        }else{
                            $('#akhir').removeClass('is-invalid')
                            $('.errorakhir').html()
                        }
                    }
                    if(respon.sukses){
                        $('#exampleModal').modal('hide')
                        tabel.ajax.reload()
                        Swal.fire(
                            respon.sukses.head,
                            respon.sukses.pesan,
                            respon.sukses.icon
                        )
                    }
                }
            })
        })
    })
</script>
<?= $this->endSection(); ?>