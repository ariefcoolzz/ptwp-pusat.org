<?php
$option = "";
UNSET($P);
$P['from'] = "view_tim AS X";
$P['where'] = "X.id_event = '$_SESSION[id_event]'";
$P['order_by'] = "X.nama_pemain ASC";
// $P['echo'] = true;
$data = $this->Model_basic->select($P);
if($data->num_rows()) 
    {
        foreach($data->result_array() AS $R)
            {
                $R['nama_pemain'] = str_replace("<br>", " & ",$R['nama_pemain']);
                $option .= "<option value='$R[id_tim]'>$R[nama_pemain]</option>";
            }
    }
?>
<div class='card'>
    <div class='card-body'>
        <div class='row'>
            <div class='col'>
                <select id='urutan' class='form-control'>
                    <option></option>
                    <?php
                    for($p=1;$p<=$_POST['per'];$p++)
                        {
                            echo "<option value='$p'>Urutan $p</option>";
                        } 
                    ?>
                </select>
            </div>
            <div class='col'>
                <select id='id_tim_A' class='form-control select2'>
                    <option></option>
                    <?php echo $option; ?>
                </select>
            </div>
            <div class='col'>
                <select id='id_tim_B' class='form-control select2'>
                    <option></option>
                    <?php echo $option; ?>
                </select>
            </div>
            <div class='col'>
                <button id='simpan' class='btn bg-success w-100'>Simpan</button>
            </div>
        </div>
    </div>
</div>

<?php
UNSET($P);
$P['select'] = "X.*, K.kategori, A.nama_pemain AS nama_pemain_tim_A, B.nama_pemain AS nama_pemain_tim_B";
$P['from'] = "data_perorangan_gugur AS X";
$P['join'][] = array("master_kategori_pemain AS K", "X.id_kategori_pemain=K.id_kategori", "LEFT");
$P['join'][] = array("view_tim AS A", "A.id_tim=X.id_tim_A", "LEFT");
$P['join'][] = array("view_tim AS B", "B.id_tim=X.id_tim_B", "LEFT");
$P['where'] = "X.id_event = '$_SESSION[id_event]' AND X.id_kategori_pemain = '$_POST[id_kategori_pemain]'";
IF($_POST['per'] != "all") $P['where'].= " AND X.per = '$_POST[per]'";

// $P['echo'] = true;
$data = $this->Model_basic->select($P);
if(!$data->num_rows()) echo "<center>Belum Ada Data</center>";
else 
    {
        echo "<div class='table-responsive'>";
        echo "<table id='data-perorangan' class='table table-primary table-striped table-borderless table-hover'>
                <thead class='text-center align-middle'>
                    <tr>
                        <th>No.</th>
                        <th>Kategori</th>
                        <th>Per</th>
                        <th>Urutan</th>
                        <th>Nama Pemain A</th>
                        <th>Nama Pemain B</th>
                    </tr>
                </thead>
                <tbody class='text-center'>";
        $no = 0;
        foreach($data->result_array() AS $R)
            {
                $no++;
                $nama_pemain_A = $R['nama_pemain_tim_A'];
                $nama_pemain_B = $R['nama_pemain_tim_B'];

                $idp = $R['id_pertandingan'];
                echo "
                        <tr>
                            <td>$no</td>
                            <td>$R[kategori]</td>
                            <td>$R[per]</td>
                            <td>$R[urutan]</td>
                            <td>
                                $nama_pemain_A
                                <input type='number' maxlength=1 class='form-control text-center set_tim_A' id='tim_A_$idp' data-id_pertandingan='$idp' value='$R[set_tim_A]'>
                            </td>
                            <td>
                                $nama_pemain_B
                                <input type='number' maxlength=1 class='form-control text-center set_tim_B' id='tim_B_$idp' data-id_pertandingan='$idp' value='$R[set_tim_B]'>
                            </td>
                        </tr>
                    ";
            }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    }
?>
<script>
    $(".select2").select2();

    $("#simpan").on('click', function() {
        var form_data = new FormData();
        form_data.append('id_kategori_pemain', $("#id_kategori_pemain").val());
        form_data.append('per', $("#per").val());
        form_data.append('urutan', $("#urutan").val());
        form_data.append('id_tim_A', $("#id_tim_A").val());
        form_data.append('id_tim_B', $("#id_tim_B").val());
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_perorangan_gugur_simpan",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: 'json',
            success: function(json) {
                if (json.status !== true) {
                    Swal.fire({
                        icon: 'error',
                        title: json.pesan,
                        showConfirmButton: false,
                        timer: 1000
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Simpan Data Berhasil',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    load();
                }
            }
        });
    });

    $(".set_tim_A,.set_tim_B").on('change', function() {
        var form_data = new FormData();
        var idp = $(this).data('id_pertandingan');
        form_data.append('id_pertandingan', idp);
        form_data.append('set_tim_A', $("#tim_A_"+idp).val());
        form_data.append('set_tim_B', $("#tim_B_"+idp).val());
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_perorangan_gugur_update",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: 'json',
            success: function(json) {
                if (json.status !== true) {
                    Swal.fire({
                        icon: 'error',
                        title: json.pesan,
                        showConfirmButton: false,
                        timer: 100
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Simpan Data Berhasil',
                        showConfirmButton: false,
                        timer: 100
                    });
                }
            }
        });
    });

    $('#data-perorangan').DataTable({
        ordering: false,
        paging:false,
        language: {
            searchPlaceholder: 'Pencarian...',
            sSearch: '',
            lengthMenu: '_MENU_ Berita/Halaman',
            // info: false
        }
    });
</script>
