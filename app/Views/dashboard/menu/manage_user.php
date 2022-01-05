 <?= $this->extend('dashboard/template/dashboard_template'); ?>
 <?= $this->section('content'); ?>
 <?= $this->include('dashboard/template/nav'); ?>
 <?= $this->include('dashboard/template/sidebar'); ?>

 <div class="container">
     <table class="table is-narrow" id="tabeluser">
     </table>
 </div>

 <!-- Modal Update User-->
 <form id="formUpdate" method="post">
     <div class="modal fade" id="ModalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h4 class="modal-title" id="myModalLabel">Edit User</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 </div>
                 <div class="modal-body">
                     <div class="form-group">
                         <img src="" id="image" width="100px" height="100px" />
                     </div>
                     <div class="form-group">
                         id
                         <input type="text" class="form-control" name="id" placeholder="id" readonly>
                     </div>
                     <div class="form-group">
                         email
                         <input type="text" class="form-control" name="email" placeholder="email" readonly>
                     </div>
                     <div class="form-group">
                         name
                         <input type="text" class="form-control" name="name" placeholder="Nama" required>
                     </div>
                     <div class="form-group">
                         asal_kampus
                         <input type="text" class="form-control" name="asal_kampus" placeholder="Asal Kampus" required>
                     </div>
                     <div class="form-group">
                         role
                         <select select class="form-control" name="role_id" placeholder="Status" required> test
                             <option value="1"> Admin </option>
                             <option value="2"> User </option>
                         </select>
                     </div>
                     <div class="form-group">
                         status
                         <select select class="form-control" name="is_active" placeholder="Status" required> test
                             <option value="1"> active </option>
                             <option value="2"> not active </option>
                         </select>
                     </div>

                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     <button type="submit" id="add-row" class="btn btn-success">Update</button>
                 </div>
             </div>
         </div>
     </div>
 </form>

 <!-- Modal Delete User-->
 <form id="formDelete" action="<?php echo base_url() . 'index.php/crud/delete' ?>" method="post">
     <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                     <h4 class="modal-title" id="myModalLabel">Delete User</h4>
                 </div>
                 <div class="modal-body">
                     <input type="hidden" name="id" required>
                     <h3> Hapus <strong id="name"></strong> ?</h3>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-danger">Hapus</button>
                 </div>
             </div>
         </div>
     </div>
 </form>


 <script>
     $(document).ready(function() {
         var table = $('#tabeluser').DataTable({
             responsive: true,
             "ajax": {
                 "type": "POST",
                 "url": "<?php echo base_url('/admin/menu/getAllUser') ?>",
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
                 [0, "asc"]
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
                     "title": "email",
                     "render": function(data, row, type, meta) {
                         return data.email;
                     }
                 },
                 {
                     "mData": null,
                     "title": "Nama User",
                     "render": function(data, row, type, meta) {
                         return data.name;
                     }
                 },
                 {
                     "mData": null,
                     "title": "Asal Kampus",
                     "render": function(data, row, type, meta) {
                         return data.asal_kampus;
                     }
                 },
                 {
                     "mData": null,
                     "title": "Role",
                     "render": function(data, row, type, meta) {
                         return data.role_id == 1 ? "admin" : "user";
                     }
                 },
                 {
                     "mData": null,
                     "title": "Status Akun",
                     "render": function(data, row, type, meta) {
                         return data.is_active == 1 ? "active" : "not active";
                     }
                 },
                 {
                     "mData": null,
                     "title": "Action",
                     "sortable": false,
                     "render": function(data, row, type, meta) {
                         let btn = '';
                         btn += "<button style='font-size: 11px;' class='btn btn-info edit_record'\
                                                    data-id='" + data.id + "'\
                                                    data-name='" + data.name + "'\
                                                    data-email='" + data.email + "'\
                                                    data-kampus='" + data.asal_kampus + "'\
                                                    data-image='" + data.image + "'\
                                                    data-role='" + data.role_id + "'\
                                                    data-status='" + data.is_active + "'\
                                                    data-image='" + data.image + "'\
                                                >Edit\
                                            </button>";

                         btn += " <button style='font-size: 11px;' class='btn btn-danger delete_record'\
                                                    data-id = '" + data.id + "'\
                                                    data-name = '" + data.name + "'\
                                                >Delete \
                                            </button>"
                         return btn;
                     }
                 }
             ]
         });



         $('#tabeluser').on('click', '.edit_record', function() {
             var id = $(this).data('id');
             var email = $(this).data('email');
             var name = $(this).data('name');
             var asal_kampus = $(this).data('kampus');
             var role = $(this).data('role');
             var status = $(this).data('status');
             var image = "<?= base_url('/assets'); ?>/" + $(this).data('image');

             $('#ModalUpdate').modal('show');
             $('[name="id"]').val(id);
             $('[name="email"]').val(email);
             $('[name="name"]').val(name);
             $('[name="asal_kampus"]').val(asal_kampus);
             $('[name="role_id"]').val(role);
             $('[name="is_active"]').val(status);
             $('#image').attr("src", image);
         });

         $('#tabeluser').on('click', '.delete_record', function() {
             var id = $(this).data('id');
             var name = $(this).data('name');

             $('#ModalDelete').modal('show');
             $('[name="id"]').val(id);
             $('#name').text(name);
         });


         $("#formUpdate").submit(function(e) {
             e.preventDefault();
             var user_data = $(this).serialize();
             var url = "<?php echo base_url('/admin/menu/update') ?>";
             $.ajax({
                 url: url,
                 type: "POST",
                 data: user_data,
                 success: function(data) {
                     $('#ModalUpdate').modal('hide');
                     table.ajax.reload();
                 },
                 error: function(xhr, ajaxOptions, thrownError) {
                     // alert(xhr.status);
                     alert(thrownError);
                     console.log(url);
                 }
             });
         });

         $("#formDelete").submit(function(e) {
             e.preventDefault();
             var user_data = $(this).serialize();
             var url = "<?php echo base_url('/admin/menu/delete') ?>";
             $.ajax({
                 url: url,
                 type: "POST",
                 data: user_data,
                 success: function(data) {
                     $('#ModalDelete').modal('hide');
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