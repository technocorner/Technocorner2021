<?= $this->extend('dashboard/template/dashboard_template'); ?>
<?= $this->section('content'); ?>
<?= $this->include('dashboard/template/nav'); ?>
<?= $this->include('dashboard/template/sidebar'); ?>
<div class="content-wrapper" style="min-height: 1643.38px;">
<div class="content">
<div class="container-fluid">
    <div class="container">
        <h2> Hasil EEC</h2>
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
</div>
</div>
</div>


    <script>
        /* Formatting function for row details - modify as you need */
        function format ( d,answer, kunjaw, result, nilai ) {
            // `d` is the original data object for the row
            return '<table class="table is-narrow childrow"'+
                '<tr>'+
                    '<td>Jawaban Peserta</td>'+
                    '<td>Kunci Jawaban</td>'+
                    '<td>Nilai</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>'+answer+'</td>'+
                    '<td>'+kunjaw+'</td>'+
                    '<td>'+result+'</td>'+
                '</tr>'+
                // '<tr>'+
                //     '<td>B.  '+d.answer2+'</td>'+
                // '</tr>'+
                // '<tr>'+
                //     '<td>C.  '+d.answer3+'</td>'+
                // '</tr>'+
                // '<tr>'+
                //     '<td>D.  '+d.answer4+'</td>'+
                // '</tr>'+
                // '<tr>'+
                //     '<td>E.  '+d.answer5+'</td>'+
                // '</tr>'+
            '</table>';
        }
        
        $(document).ready(function() {
            var table = $('#tabelteam').DataTable({
                responsive: true,
                "ajax": {
                    "type": "POST",
                    "url": "<?php echo base_url('/admin/menu/getHasilEEC') ?>",
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
                        "targets": 1,
                        "className": "text-center",
                    },
                    // {
                    //     "targets": 2,
                    //     "className": "text-center",
                    // },
                    // {
                    //     "targets": 3,
                    //     "className": "text-center",
                    // },
                    // {
                    //     "targets": 4,
                    //     "className": "text-center",
                    // },
                ],
                "aoColumns": [{
                        "mData": null,
                        "title": "Nama Team",
                        render: function(data, type, row, meta) {
                            return data.team_name;
                        }
                    },
                    // {
                    //     "mData": null,
                    //     "title": "Pertanyaan",
                    //     "render": function(data, row, type, meta) {
                    //         // var test = "";
                    //         // jQuery.each(JSON.parse(data.answer), function(i, val) {
                    //         //   test += i + ". "
                    //         //   test += val + "  "
                    //         //   test += 
                    //         //   test += "<br />"
                    //         // });
                            
                    //         // return test;
                            
                    //         var result = "";
                    //         jQuery.each(JSON.parse(data.kunjaw), function(i, val) {
                    //           result += i + ". "
                    //           result += Object.values(JSON.parse(data.answer))[i-1]
                    //           result += "<br />"
                    //         });
                    //         result += "&nbsp;"
                            
                    //         return result;
                    //     }
                    // },
                    // {
                    //     "mData": null,
                    //     "title": "Kunci Jawaban",
                    //     "render": function(data, row, type, meta) {
                    //         var result = "";
                    //         jQuery.each(JSON.parse(data.kunjaw), function(i, val) {
                    //           result += i + ". "
                    //           result += val
                    //           result += "<br />"
                    //         });
                    //         result += "&nbsp;"
                            
                    //         return result;
                    //     }
                    // },
                    {
                        "mData": null,
                        "title": "Nilai",
                        "render": function(data, row, type, meta) {
                            var nilai = 0;
                            
                            jQuery.each(JSON.parse(data.kunjaw), function(i, val) {
                              var checkAnswer = Object.values(JSON.parse(data.answer))[i-1];
                              nilai += checkAnswer == "" ? 0 : (checkAnswer == val ? 4 : -1);
                            });
                            
                            return nilai;
                        }
                    },
                    {
                        "mData": null,
                        "title": "Waktu Submit",
                        "render": function(data, row, type, meta) {
                            return data.time;
                        }
                    },
                    // {
                    //     "mData": null,
                    //     "title": "Action",
                    //     "sortable": false,
                    //     "render": function(data, row, type, meta) {
                    //         return null
                    //         // let btn = '';

                    //         // btn += " <button style='font-size: 11px;' class='btn btn-dark change_status'\
                    //         //                 data-id = '" + data.id + "'\
                    //         //                 data-question = '" + data.question + "'\
                    //         //                 data-kunjaw = '" + data.kunjaw + "'\
                    //         //                 data-answer1 = '" + data.answer1 + "'\
                    //         //                 data-answer2 = '" + data.answer2 + "'\
                    //         //                 data-answer3 = '" + data.answer3 + "'\
                    //         //                 data-answer4 = '" + data.answer4 + "'\
                    //         //                 data-answer5 = '" + data.answer5 + "'\
                    //         //             >Edit Question\
                    //         //         </button>"
                    //         // return btn;
                    //     }
                    // }
                    {
                        "className":      'details-control',
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": ''
                    }
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
                    var dataKunjaw = JSON.parse(row.data().kunjaw);
                    var dataAnswer = JSON.parse(row.data().answer);
                            
                    var answer = "";
                    var kunjaw = "";
                    var result = "";
                    var nilai = 0;
                    
                    jQuery.each(dataKunjaw, function(i, val) {
                      answer += i + ". "
                      answer += Object.values(dataAnswer)[i-1]
                      answer += "<br />"
                      
                      kunjaw += i + ". "
                      kunjaw += val
                      kunjaw += "<br />"
                      
                      var checkAnswer = Object.values(dataAnswer)[i-1]
                      
                      result += checkAnswer == "" ? "0" : (checkAnswer == val ? "4" : "-1");
                      result += "<br />"
                      nilai += checkAnswer == "" ? 0 : (checkAnswer == val ? 4 : -1);
                    });
                    answer += "&nbsp;"
                    kunjaw += "&nbsp;"
                    result += "Total: " + nilai;
                    
                    row.child( format(row.data(), answer, kunjaw, result, nilai) ).show();
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