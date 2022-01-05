    <?= $this->extend('dashboard/template/dashboard_template'); ?>
    <?= $this->section('content'); ?>
    <?= $this->include('dashboard/template/nav'); ?>
    <?= $this->include('dashboard/template/sidebar'); ?>
    <div class="container">
        <h2> Manage Team <?= $lomba; ?></h2>
        <li> Competition
            <ul>
                <li><a href="<?= base_url('/admin/menu/manageTeam'); ?>"> All </a></li>
                <li><a href="<?= base_url('/admin/menu/manageTeam?lomba=linefollower'); ?>"> Line Follower </a></li>
                <li><a href="<?= base_url('/admin/menu/manageTeam?lomba=transporter'); ?>"> Transporter </a></li>
                <li><a href="<?= base_url('/admin/menu/manageTeam?lomba=eec'); ?>"> EEC </a></li>
                <li><a href="<?= base_url('/admin/menu/manageTeam?lomba=iot'); ?>"> IOT </a></li>
                <li><a href="<?= base_url('/admin/menu/manageTeam?lomba=video'); ?>"> Video Animation </a></li>
            </ul>
        </li>
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
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="myModalLabel">Change Status</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="team_id" required>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 control-label">Team Name</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="team_name" placeholder="Team Name" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 control-label">Team Status</label>
                            <div class="col-sm-7">
                                <select class="form-control" name="is_paid" id="team_status" placeholder="Team Status" required>
                                    <option value="1"> Paid </option>
                                    <option value="0"> Not Paid </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
                        <button type="submit" class="btn btn-primary" disabled> Change Status </button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <script>
        $(document).ready(function() {
            var table = $('#tabelteam').DataTable({
                responsive: true,
                "ajax": {
                    "type": "POST",
                    "url": "<?php echo base_url('/admin/menu/getAllTeam') ?>",
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
                        "targets": 4,
                        "className": "text-center",
                    },
                    {
                        "targets": 5,
                        "className": "text-center",
                    },
                    {
                        "targets": 6,
                        "className": "text-center",
                    }
                ],
                "aoColumns": [{
                        "mData": null,
                        "title": "No",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        "mData": null,
                        "title": "Lomba",
                        "render": function(data, row, type, meta) {
                            return data.nama_lomba;
                        }
                    },
                    {
                        "mData": null,
                        "title": "Nama Team",
                        "render": function(data, row, type, meta) {
                            return data.team_name;
                        }
                    },
                    {
                        "mData": null,
                        "title": "Leader",
                        "render": function(data, row, type, meta) {
                            return data.leader;
                        }
                    },
                    {
                        "mData": null,
                        "title": "Email",
                        "render": function(data, row, type, meta) {
                            return data.email;
                        }
                    },
                    {
                        "mData": null,
                        "title": "Kontak",
                        "render": function(data, row, type, meta) {
                            return data.kontak;
                        }
                    },
                    {
                        "mData": null,
                        "title": "Image_payment",
                        "render": function(data, row, type, meta) {
                            var url = data.image_payment;
                            return `<img class='image' src='<?= base_url('/uploads/team/image_payment'); ?>/${url}' 
                                                        width='100px' 
                                                        height='100px'
                                                        data-source='<?= base_url('uploads/team/image_payment'); ?>/${url}' />`;
                        }
                    },
                    {
                        "mData": null,
                        "title": "Status Team",
                        "render": function(data, row, type, meta) {
                            return data.is_paid == 1 ? "Paid" : "Not Paid";
                        }
                    },
                    {
                        "mData": null,
                        "title": "Action",
                        "sortable": false,
                        "render": function(data, row, type, meta) {
                            let btn = '';

                            btn += " <button style='font-size: 11px;' class='btn btn-primary change_status'\
                                            data-team_id = '" + data.team_id + "'\
                                            data-is_paid = '" + data.is_paid + "'\
                                            data-team_name = '" + data.team_name + "'\
                                        >Change Status \
                                    </button>"
                            return btn;
                        }
                    },
                    {
                        "className": 'details-control',
                        "orderable": false,
                        "data": null,
                        "defaultContent": ''
                    },
                ],
                createdRow: function(row, data, index) {
                    var td = $(row).find("td:first");
                    td.removeClass('details-control');
                },
                rowCallback: function(row, data, index) {
                    //console.log('rowCallback');
                }
            });

            // Add event listener for opening and closing first level childdetails
            $('#tabelteam tbody').on('click', 'td.details-control', function() {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var rowData = row.data();

                //get index to use for child table ID and team_id
                var index = row.index();
                var id = row.data().team_id;

                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child(
                        '<table id = "child_details' + index + '" class="childrow" cellpadding="5" cellspacing="0" border="0" >' +
                        '</table>', ['active']).show();

                    var childTable = $('#child_details' + index).DataTable({
                        "ajax": {
                            "type": "POST",
                            "url": "<?php echo base_url('/admin/menu/getTeamMember') ?>",
                            "data": {
                                "team_id": `${id}`
                            },
                            "timeout": 120000,
                            "dataSrc": function(json) {
                                if (json != null) {
                                    return json
                                } else {
                                    return "";
                                }
                            }
                        },
                        "paging": false,
                        "ordering": false,
                        "info": false,
                        "searching": false,
                        "destroy": true,
                        "columnDefs": [{
                                "targets": 0,
                                "className": "text-center",
                            },
                            {
                                "targets": 2,
                                "className": "text-center",
                            },
                            {
                                "targets": 3,
                                "className": "text-center",
                            },
                            {
                                "targets": 4,
                                "className": "text-center",
                            }
                        ],
                        "aoColumns": [{
                                "mData": null,
                                "title": "No",
                                render: function(data, type, row, meta) {
                                    return meta.row + meta.settings._iDisplayStart + 1;
                                }
                            },
                            {
                                "mData": null,
                                "title": "Nama",
                                "render": function(data, row, type, meta) {
                                    return data.name;
                                }
                            },
                            {
                                "mData": null,
                                "title": "Twibbon",
                                "render": function(data, row, type, meta) {

                                    return data.image;
                                }
                            },
                            {
                                "mData": null,
                                "title": "KTP",
                                "render": function(data, row, type, meta) {
                                    var url = data.ktp
                                    return `<img class='image' src='<?= base_url('uploads/user'); ?>/${url}'
                                                                            width='100px' 
                                                                            height='100px'
                                                                            data-source='<?= base_url('uploads/user'); ?>/${url}' 
                                                                            />`;
                                }
                            },
                            {
                                "mData": null,
                                "title": "KTM",
                                "render": function(data, row, type, meta) {
                                    var url = data.ktm
                                    return `<img class='image' src='<?= base_url('uploads/team/member_team'); ?>/${url}' 
                                                                            width='100px' 
                                                                            height='100px'
                                                                            data-source='<?= base_url('uploads/team/member_team'); ?>/${url}' 
                                                                            />`;
                                }
                            },
                        ],
                    });
                    tr.addClass('shown');
                }
            });

            $('#tabelteam').on('click', '.change_status', function() {
                var team_id = $(this).data('team_id');
                var team_name = $(this).data('team_name');
                var is_paid = $(this).data('is_paid');

                $('#ModalChangeStatus').modal('show');
                $('[name="team_id"]').val(team_id);
                $('[name="team_name"]').val(team_name);
                $('[name="is_paid"]').val(is_paid);
            });

            //enable submit
            $('#team_status').change(function() {
                $(':input[type="submit"]').prop('disabled', false);
            });

            $('#tabelteam').on('click', '.image', function() {
                var source = $(this).data('source');
                $('#ModalImage').modal('show');
                $("#image_zoom").attr("src", source);
            });

            $("#formUpdate").submit(function(e) {
                e.preventDefault();
                var team_data = $(this).serialize();
                var url = "<?php echo base_url('/admin/menu/updateTeam') ?>";
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