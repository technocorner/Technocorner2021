<?= $this->extend('dashboard/template/dashboard_template'); ?>
<?= $this->section('content'); ?>
<?= $this->include('dashboard/template/nav'); ?>
<?= $this->include('dashboard/template/sidebar'); ?>

<div class="container">
    <button class="btn btn-primary" id="btnAddPemberitahuan">Add Pemberitahuan</button>
    <br />
    <br />
    <br />
    <table class="table is-narrow" id="tabelpemberitahuan">
    </table>
</div>

<!-- Modal Add Pemberitahuan-->
<div class="modal fade" id="ModalAddPemberitahuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formAddPemberitahuan" class="eventInsForm">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="type">Tipe Pemberitahuan</label>
                        <select class="form-control" id="type" name="type">
                            <option value="1">User</option>
                            <option value="2">Lomba</option>
                            <option value="3">All</option>
                        </select>
                    </div>
                    <div class="form-group" id="users">
                        <label for="lomba">User</label>
                        <table id="userTable" class="table order-list">
                            <tbody>
                                <tr>
                                    <td class="col-sm-8">
                                        <input type="text" id="name" name="name[]" class="form-control" placeholder="Enter name" />
                                        <input type="text" id="user_id" name="identity[]" class="form-control user_id" style="display: none" />
                                    </td>
                                    <td class="col-sm-2"><a class="deleteRow"></a>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" style="text-align: left;">
                                        <input type="button" class="btn btn-lg btn-block btn-dark" id="addrow" value="Add Row" />
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="form-group" id="lomba" style="display:none">
                        <label for="lomba">Lomba</label>
                        <select class="form-control" id="identity" name="identity">
                            <option selected></option>
                            <option value="1">Line Follower</option>
                            <option value="2">Transporter</option>
                            <option value="3">IOT</option>
                            <option value="4">EEC</option>
                            <option value="5">Video Competition</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input class="form-control" id="judul" name="judul" placeholder="Judul Pemberitahuan">
                    </div>
                    <div class="form-group">
                        <label for="isi">Isi Pemberitahuan</label>
                        <textarea class="form-control" id="isi" name="isi" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Pemberitahuan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Lihat Detail-->
<div class="modal fade" id="ModalDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p> Tipe: <span id="typePemberitahuan"> tipe </span></p>
                <p> Dibuat: <span id="dibuatPemberitahuan"> tanggal </span></p>
                <p> Tujuan Penerima: <span id="tujuanPemberitahuan"> tanggal </span></p>
                <p> Judul: <span id="judulPemberitahuan" style="font-weight: bold"> text </span></p>
                <p> Isi Pemberitahuan:
                <p id="isiPemberitahuan"> isi </p>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus-->
<form id="formDelete">
    <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="id" name="id" style="display: none" />
                    <p> Tipe: <span id="typePemberitahuan"> tipe </span></p>
                    <p> Dibuat: <span id="dibuatPemberitahuan"> tanggal </span></p>
                    <p> Tujuan Penerima: <span id="tujuanPemberitahuan"> tanggal </span></p>
                    <p> Judul: <span id="judulPemberitahuan" style="font-weight: bold"> text </span></p>
                    <p> Isi Pemberitahuan:
                    <p id="isiPemberitahuan"> isi </p>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</form>


<script>
    $(document).ready(function() {
        var table = $('#tabelpemberitahuan').DataTable({
            responsive: true,
            "ajax": {
                "type": "POST",
                "url": "<?php echo base_url('/admin/menu/getListPemberitahuan') ?>",
                "timeout": 120000,
                "dataSrc": function(json) {
                    if (json != null) {
                        return json
                    } else {
                        return "";
                    }
                }
            },
            "sAjaxDataProp": "",
            "width": "100%",
            "order": [
                [0, "desc"]
            ],
            "columnDefs": [{
                    "targets": 0,
                    "className": "text-center",
                    "width": "20%",
                },
                {
                    "targets": 1,
                    "className": "text-center",
                    "width": "20%",
                },
                {
                    "targets": 2,
                    "width": "20%",
                },
                {
                    "targets": 2,
                    "width": "20%",
                },
                {
                    "targets": 4,
                    "className": "text-center",
                    "width": "20%",
                },
            ],
            "aoColumns": [{
                    "mData": null,
                    "title": "Creation Date",
                    "render": function(data, row, type, meta) {
                        return data.created_at;
                    }
                },
                {
                    "mData": null,
                    "title": "Tipe",
                    "render": function(data, row, type, meta) {
                        return data.type;
                    }
                },
                {
                    "mData": null,
                    "title": "Judul",
                    "render": function(data, row, type, meta) {
                        return data.judul;
                    }
                },
                {
                    "mData": null,
                    "title": "Penerima",
                    "render": function(data, row, type, meta) {
                        if (data.type_id == 1) {
                            var identity = '<ol style="  display: table; margin: 0 auto; line-height: 0.5;"><li>';
                            identity += data.identity.replace(/,/g, '</li><br><li>');
                            identity += '</li></ol>';
                            return identity;
                        } else {
                            var identity = '<div class="text-center">';
                            identity += data.identity;
                            identity += '</div>';
                            return identity;
                        };
                    }
                },
                {
                    "mData": null,
                    "title": "Action",
                    "sortable": false,
                    "render": function(data, row, type, meta) {
                        var identity = ''
                        if (data.type_id == 1) {
                            identity += '<ol style="line-height: 0.8;"><li>';
                            identity += data.identity.replace(/,/g, '</li><br><li>');
                            identity += '</li></ol>';
                        } else {
                            identity += '<span>';
                            identity += data.identity;
                            identity += '</span>';
                        };

                        let btn = '';
                        btn += "<button style='font-size: 11px;' class='btn btn-info lihat_detail'\
                                                    data-id='" + data.pemberitahuan_id + "'\
                                                    data-type='" + data.type + "'\
                                                    data-dibuat='" + data.created_at + "'\
                                                    data-identity='" + identity + "'\
                                                    data-judul='" + data.judul + "'\
                                                    data-isi='" + data.isi + "'\
                                                >Detail\
                                            </button>";

                        btn += " <button style='font-size: 11px;' class='btn btn-danger delete'\
                                                    data-id='" + data.pemberitahuan_id + "'\
                                                    data-type='" + data.type + "'\
                                                    data-dibuat='" + data.created_at + "'\
                                                    data-identity='" + identity + "'\
                                                    data-judul='" + data.judul + "'\
                                                    data-isi='" + data.isi + "'\
                                                >Delete \
                                            </button>"
                        return btn;
                    }
                }
            ]
        });

        //onclick add pemberitahuan
        $("#btnAddPemberitahuan").on("click", function() {
            $('#ModalAddPemberitahuan').modal('show');
        });

        //onclick lihat detail
        $('#tabelpemberitahuan').on('click', '.lihat_detail', function() {
            var id = $(this).data('id');
            var type = $(this).data('type');
            var dibuat = $(this).data('dibuat');
            var identity = $(this).data('identity');
            var judul = $(this).data('judul');
            var isi = $(this).data('isi');

            $('#ModalDetail').modal('show');
            $('#typePemberitahuan').text(type);
            $('#dibuatPemberitahuan').text(dibuat);
            $('#tujuanPemberitahuan').html(identity);
            $('#judulPemberitahuan').text(judul);
            $('#isiPemberitahuan').text(isi);
        });

        //change type
        $('#type').on('change', function() {
            if (this.value == 1) {
                $('#lomba').hide();
                $('#users').show();
            } else if (this.value == 2) {
                $('#users').hide();
                $('#lomba').show();
            } else {
                $('#identity').val('');
                $('#users').hide();
                $('#lomba').hide();
            }
        });

        //add row 
        var counter = 0;
        $("#addrow").on("click", function() {
            counter++;
            var newRow = $("<tr>");
            var cols = "";

            cols += '<td><input type="text" class="form-control name" id="name' + counter + '" name="name[]" placeholder="Enter name"/>';
            cols += '<input type="text" class="form-control user_id" id="user_id' + counter + '" name="identity[]" style="display: none"/></td>';
            cols += '<td><input type="button" class="deleteButton btn btn-md btn-danger"  value="Delete"></td>';
            newRow.append(cols);
            $("#userTable").append(newRow);

            $("#name" + counter).autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "<?php echo base_url('/admin/menu/getUserAutocomplete') ?>",
                        type: 'POST',
                        dataType: "json",
                        data: {
                            term: request.term
                        },
                        success: function(data) {
                            response($.map(data, function(v, i) {
                                return {
                                    label: v.name,
                                    value: v.name,
                                    id: v.id
                                };
                            }));
                        }
                    });
                },
                select: function(event, ui) {
                    var row = $(this).closest("tr");
                    row.find('.user_id').val(ui.item.id);
                },
            });
            $("#name" + counter).autocomplete("option", "appendTo", ".eventInsForm");
        });

        $("#userTable").on("click", ".deleteButton", function(event) {
            $(this).closest("tr").remove();
        });
        // end of add row

        //auto complete input name
        $("#name").autocomplete({
            select: function(event, ui) {
                $('#user_id').val(ui.item.id);
            },
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo base_url('/admin/menu/getUserAutocomplete') ?>",
                    type: 'POST',
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response($.map(data, function(v, i) {
                            return {
                                label: v.name,
                                value: v.name,
                                id: v.id
                            };
                        }));
                    }
                });
            }
        });
        $("#name").autocomplete("option", "appendTo", ".eventInsForm");
        //end of auto complete

        //when form add submit
        $("#formAddPemberitahuan").submit(function(e) {
            e.preventDefault();
            if ($('#type').val() != "1") {
                var user_data = $(this).serializeArray();
                var url = "<?php echo base_url('/admin/menu/addPemberitahuan') ?>";
                console.log(user_data);
                $.ajax({
                    url: url,
                    type: "POST",
                    data: user_data,
                    success: function(data) {
                        table.ajax.reload()

                        $('#ModalAddPemberitahuan').modal('hide');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        // alert(xhr.status);
                        alert(thrownError);
                        console.log(url);
                    }
                });
            } else {
                var user_data = $('#formAddPemberitahuan, input[name="identity[]"]').serializeArray();
                var url = "<?php echo base_url('/admin/menu/addPemberitahuan') ?>";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: user_data,
                    success: function(data) {
                        console.log(user_data)
                        table.ajax.reload()
                        $('#ModalAddPemberitahuan').modal('hide');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        // alert(xhr.status);
                        alert(thrownError);
                        console.log(url);
                    }
                });
            }
        });


        //onclick lihat detail
        $('#tabelpemberitahuan').on('click', '.delete', function() {
            var id = $(this).data('id');
            var type = $(this).data('type');
            var dibuat = $(this).data('dibuat');
            var identity = $(this).data('identity');
            var judul = $(this).data('judul');
            var isi = $(this).data('isi');

            $('#ModalDelete').modal('show');
            $('#typePemberitahuan').text(type);
            $('#dibuatPemberitahuan').text(dibuat);
            $('#tujuanPemberitahuan').html(identity);
            $('#judulPemberitahuan').text(judul);
            $('#isiPemberitahuan').text(isi);
            $('#id').val(id);
        });

        //when form delete submit
        $("#formDelete").submit(function(e) {
            e.preventDefault();
            var user_data = $(this).serializeArray();
            var url = "<?php echo base_url('/admin/menu/deletePemberitahuan') ?>";
            $.ajax({
                url: url,
                type: "POST",
                data: user_data,
                success: function(data) {
                    table.ajax.reload()
                    $('#ModalDelete').modal('hide');
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