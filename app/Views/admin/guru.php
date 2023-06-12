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
                        <button type="button" class="btn btn-success btnImport" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Import
                        </button>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive datatable-minimal">
                                <table id="tabelData" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>L/P</th>
                                            <th>Tempat , Tgl Lahir</th>
                                            <th>Email</th>
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
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <form class="" action="" id="formImport">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
            </div>
            <div class="modal-body">
                <div class="mb-3 row">
                    <label for="file" class="col-md-2 mt-2 col-form-label">Pilih File</label>
                    <div class="col-md-8 mt-2">
                        <input type="file" class="form-control" id="file" name="file" accept=".xlsx,.xls">
                        <div class="errorfile invalid-feedback"></div>
                    </div>
                    <div class="col-md-2 mt-2">
                        <a href="" class="btn btn-success">Download Format</a>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
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
            ajax: '/admin/dataguru',
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
        $('.btnImport').click(function(e){
            $('.modal-title').html('Import Data Guru')
            $('.btnSave').html('Import')
        })


        
        $(document).on('submit','#formImport',function(e){
            e.preventDefault();
            $.ajax({
                url : '/admin/data-guru',
                method : 'post',
                data : new FormData(this),
                enctype : 'multipart/form-data',
                processData: false,
                contentType: false,
                cache : false,
                dataType : 'json',
                success : function(respon){
                    console.log(respon)
                    if(respon.error){
                        if(respon.error.file){
                            $('#file').addClass('is-invalid')
                            $('.errorfile').html(respon.error.file)
                        }else{
                            $('#file').removeClass('is-invalid')
                            $('.errorfile').html()
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