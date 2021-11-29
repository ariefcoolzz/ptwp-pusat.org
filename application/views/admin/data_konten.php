<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $judul; ?></li>
            </ol>
        </nav>
        <a href="#" id_konten="0" class="btn-tambah btn btn-info btn-xs"><i class="fa fa-plus-circle"></i> Konten / Page Baru</a>    
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                 <?php echo $this->session->flashdata('msg'); ?>
                <div data-label="Example" class="df-example demo-table">
                    <div class="table-responsive">
                        <table class="table mg-b-0">
                            <thead class="thead-primary">
                                <tr align="center">
                                    <th scope="col">No</th>
                                    <th scope="col">Alias</th>
                                    <th scope="col">Judul Konten / Page</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 1;
                                    foreach($list_konten->result_array() as $R){
                                        echo '<tr align="center">';
                                        echo "<td>".$no."</td>";   
                                        echo "<td>".$R['alias']."</td>";   
                                        echo "<td align='left'>".$R['judul']."</td>";   
                                        if($R['is_publish']){
                                            echo '<td><span class="badge badge-success">Dipublikasikan</span></td>';   
                                        }
                                        else{
                                            echo '<td><span class="badge badge-danger">Tidak Dipublikasikan</span></td>';  
                                        }
                                        echo '<td>
                                        <a href="#" id_konten="'.$R['id'].'" class="btn-tambah btn btn-xs btn-outline-success btn-rounded"><i class="fas fa-pencil-alt"></i> Edit</a>
                                        <a href="#" class="btn btn-xs btn-outline-danger btn-rounded"><i class="fas fa fa-times"></i> Hapus</a></td>';
                                        echo "</tr>";
                                        $no++;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div><!-- table-responsive -->
                </div><!-- df-example -->
            </div>
        </div>
    </div>
</div>
<script>
    $(".btn-tambah").on("click", function() {
        //loader
        $(".title_loader").text("Sedang Memuat Halaman");         
        $("#konten").html($("#loader_html").html());
        // $('.nav-item.active').removeClass('active');
        // $(this).closest('li.nav-item').addClass('active');
        //loader
        // skip();
        var form_data = new FormData();
        form_data.append('id_konten', $(this).attr('id_konten'));
        $.ajax({
            url: "<?php echo base_url(); ?>admin/form_data_konten",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: 'json',
            success: function(html) {
                if (html.status !== true) {
                    location.reload();
                } 
                else {
                    $("body").scrollTop('0px');
                    $("#konten").fadeOut(300);
                    $("#konten").html(html.konten_menu);
                    $("#konten").fadeIn(300);
                    
                }
            }
        });
    });
    
    </script>        