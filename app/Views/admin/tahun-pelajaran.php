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
                            <button class="btn btn-primary btnAdd">Tambah</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive datatable-minimal">
                                <table id="tabelData" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun Pelajaran</th>
                                            <th>Semester</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
<?= $this->endSection(); ?>
<?= $this->section('js'); ?>
<script>
    $(document).ready(function(){
        var tabel = $('#tabelData').DataTable({
            processing: true,
            serverSide: true,
            order: [], //this mean no init order on datatable
            ajax: '/admin/tahunPelajaran',
            columns : [
                {data : 'nomor',orderable:false},
                {data : 'tp',orderable:false},
                {data : 'smt',orderable:false},
                {
                    data : 'status',orderable:false,
                    mRender:function(data,type,full){
                        if(data == 1){
                            return html = '<span class="btn btn-success"><i class="bi bi-power"></i></span>'
                        }else{
                            return html = '<span id="'+full['id_tahun']+'" class="btn btn-danger btnActive" ><i class="bi bi-power"></i></span>'
                        }
                    }
                },
            ]
        })
        $(document).on('click','.btnActive',function(e){
            e.preventDefault();
            var id = $(this).attr('id');
            $.ajax({
                url : '/admin/tahun-pelajaran',
                method : 'post',
                data : {id:id,_method:'PUT'},
                success:function(respon){
                    tabel.ajax.reload();
                }
            })
        })
        $('.btnAdd').click(function(e){
            e.preventDefault();
            $.ajax({
                url : '/admin/tahun-pelajaran',
                method : 'post',
                data : {_method : 'POST'},
                dataType : 'json',
                success :function(respon){
                    tabel.ajax.reload();
                    Swal.fire(
                        respon.head,
                        respon.pesan,
                        respon.icon
                        )
                }
            })
        })
    })
</script>
<?= $this->endSection(); ?>