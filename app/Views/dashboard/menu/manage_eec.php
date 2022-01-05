<?= $this->extend('dashboard/template/dashboard_template'); ?>
<?= $this->section('content'); ?>
<?= $this->include('dashboard/template/nav'); ?>
<?= $this->include('dashboard/template/sidebar'); ?>
<div class="content-wrapper" style="min-height: 1643.38px;">
<div class="content">
<div class="container-fluid">
    <div class="container">
        <h2> Manage EEC</h2>
        <table class="table is-narrow" id="tabelteam">
        </table>
    </div>

    <!-- zoom image modal  -->
    <div class="modal fade" id="ModalImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <!-- <h4 class="modal-title text-center" id="myModalLabel">Image</h4> -->
                </div>
                <div class="modal-body text-center">
                    <img id="image_zoom" src="" width="500px" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Change Team Status-->
    <form id="formUpdate" class="form-horizontal">
        <div class="modal fade" id="ModalChangeStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 100%; padding-left: 10px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-center" id="myModalLabel">Change Status</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="team_id" required>
                        <div class="form-group row">
                            <label for="id" class="col-sm-3 control-label">Nomor</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="id" placeholder="nomor" readonly>
                            </div>
                        </div>
                        <!--<div class="form-group row">-->
                        <!--    <label for="question" class="col-sm-3 control-label">Pertanyaan</label>-->
                        <!--    <div class="col-sm-7">-->
                        <!--        <textarea class="form-control" name="question" placeholder="Pertanyaan"> </textarea/>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="form-group row">
                            <label for="kunjaw" class="col-sm-3 control-label">Kunci Jawaban</label>
                            <div class="col-sm-7">
                                <select class="form-control" name="kunjaw" id="kunjaw" placeholder="Kunci Jawaban" required>
                                    <option value="A"> A </option>
                                    <option value="B"> B </option>
                                    <option value="C"> C </option>
                                    <option value="D"> D </option>
                                    <option value="E"> E </option>
                                </select>
                            </div>
                        </div>
                    <!--    <div class="form-group row">-->
                    <!--        <label for="answer1" class="col-sm-3 control-label text-center">A</label>-->
                    <!--        <div class="col-sm-7">-->
                    <!--            <input type="text" class="form-control" name="answer1" placeholder="Opsi 1">-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--    <div class="form-group row">-->
                    <!--        <label for="answer2" class="col-sm-3 control-label text-center">B</label>-->
                    <!--        <div class="col-sm-7">-->
                    <!--            <input type="text" class="form-control" name="answer2" placeholder="Opsi 2">-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--    <div class="form-group row">-->
                    <!--        <label for="answer3" class="col-sm-3 control-label text-center">C</label>-->
                    <!--        <div class="col-sm-7">-->
                    <!--            <input type="text" class="form-control" name="answer3" placeholder="Opsi 3">-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--    <div class="form-group row">-->
                    <!--        <label for="answer4" class="col-sm-3 control-label text-center">D</label>-->
                    <!--        <div class="col-sm-7">-->
                    <!--            <input type="text" class="form-control" name="answer4" placeholder="Opsi 4">-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--    <div class="form-group row">-->
                    <!--        <label for="answer5" class="col-sm-3 control-label text-center">E</label>-->
                    <!--        <div class="col-sm-7">-->
                    <!--            <input type="text" class="form-control" name="answer5" placeholder="Opsi 5">-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
                        <button type="submit" class="btn btn-warning" > Confirm </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
</div>


    <script>
        /* Formatting function for row details - modify as you need */
        function format ( d ) {
            // `d` is the original data object for the row
            return '<table class="table is-narrow childrow"'+
                '<tr>'+
                    '<td>A.  '+d.answer1+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>B.  '+d.answer2+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>C.  '+d.answer3+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>D.  '+d.answer4+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>E.  '+d.answer5+'</td>'+
                '</tr>'+
            '</table>';
        }
    
        $(document).ready(function() {
            var table = $('#tabelteam').DataTable({
                responsive: true,
                "ajax": {
                    "type": "POST",
                    "url": "<?php echo base_url('/admin/menu/getAllQuestion') ?>",
                    "timeout": 120000,
                    "data": {
                        "lomba_id": <?= $lomba_id; ?> + '',
                    },
                    "dataSrc": function(json) {
                        if (json != null) {
                            return json
                        } else {
                            return "";
                        }
                    }
                },
                "width": "100%",
                "order": [
                    [0, "asc"]
                ],
                "columnDefs": [{
                        "targets": 0,
                        "className": "text-center",
                    },
                    {
                        "targets": 2,
                        "className": "text-center",
                    },
                ],
                "aoColumns": [{
                        "mData": null,
                        "title": "No",
                        render: function(data, type, row, meta) {
                            return data.id;
                        }
                    },
                    // {
                    //     "mData": null,
                    //     "title": "Pertanyaan",
                    //     "render": function(data, row, type, meta) {
                    //         return data.question;
                    //     }
                    // },
                    {
                        "mData": null,
                        "title": "Kunci Jawaban",
                        "render": function(data, row, type, meta) {
                            return data.kunjaw;
                        }
                    },
                    // {
                    //     "mData": null,
                    //     "title": "Opsi 1",
                    //     "render": function(data, row, type, meta) {
                    //         return data.answer1;
                    //     }
                    // },
                    // {
                    //     "mData": null,
                    //     "title": "Opsi 2",
                    //     "render": function(data, row, type, meta) {
                    //         return data.answer2;
                    //     }
                    // },
                    // {
                    //     "mData": null,
                    //     "title": "Opsi 3",
                    //     "render": function(data, row, type, meta) {
                    //         return data.answer3;
                    //     }
                    // },
                    // {
                    //     "mData": null,
                    //     "title": "Opsi 4",
                    //     "render": function(data, row, type, meta) {
                    //         return data.answer4;
                    //     }
                    // },
                    // {
                    //     "mData": null,
                    //     "title": "Opsi 5",
                    //     "render": function(data, row, type, meta) {
                    //         return data.answer5;
                    //     }
                    // },
                    {
                        "mData": null,
                        "title": "Action",
                        "sortable": false,
                        "render": function(data, row, type, meta) {
                            let btn = '';

                            btn += " <button style='font-size: 11px;' class='btn btn-dark change_status'\
                                            data-id = '" + data.id + "'\
                                            data-question = '" + data.question + "'\
                                            data-kunjaw = '" + data.kunjaw + "'\
                                            data-answer1 = '" + data.answer1 + "'\
                                            data-answer2 = '" + data.answer2 + "'\
                                            data-answer3 = '" + data.answer3 + "'\
                                            data-answer4 = '" + data.answer4 + "'\
                                            data-answer5 = '" + data.answer5 + "'\
                                        >Edit Kunjaw\
                                    </button>"
                            return btn;
                        }
                    },
                    // {
                    //     "className":      'details-control',
                    //     "orderable":      false,
                    //     "data":           null,
                    //     "defaultContent": ''
                    // }
                ]
            });

            $('#tabelteam').on('click', '.change_status', function() {
                var id = $(this).data('id');
                var question = $(this).data('question');
                var kunjaw = $(this).data('kunjaw');
                var answer1 = $(this).data('answer1');
                var answer2 = $(this).data('answer2');
                var answer3 = $(this).data('answer3');
                var answer4 = $(this).data('answer4');
                var answer5 = $(this).data('answer5');

                $('#ModalChangeStatus').modal('show');
                $('[name="id"]').val(id);
                $('[name="question"]').val(question);
                $('[name="kunjaw"]').val(kunjaw);
                $('[name="answer1"]').val(answer1);
                $('[name="answer2"]').val(answer2);
                $('[name="answer3"]').val(answer3);
                $('[name="answer4"]').val(answer4);
                $('[name="answer5"]').val(answer5);
            });
     
            // Add event listener for opening and closing details
            $('#tabelteam tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row( tr );
         
                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
            } );

            $("#formUpdate").submit(function(e) {
                e.preventDefault();
                var team_data = $(this).serialize();
                var url = "<?php echo base_url('/admin/menu/updateQuestion') ?>";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: team_data,
                    success: function(data) {
                        $('#ModalChangeStatus').modal('hide');
                        table.ajax.reload();
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        // alert(xhr.status);
                        alert(thrownError);
                        console.log(url);
                    }
                });
            });
        });
    </script>
    <?= $this->endSection(); ?>