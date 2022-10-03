<script src="<?php echo base_url(); ?>assets/lib/jquery/jquery.min.js"></script>
<form id="form_register" method="post">
nip (max 18 digit): <input type='text' placeholder='198701262006041002' maxlength='18' id='nip' name='nip'>
<br>
nama: <input type='text' placeholder='Dika Andrian' id='nama' name='nama'>
<br>
Nomor WA: <input type='text' placeholder='081298078787' id='no_wa' name='no_wa'>
<br>
Panitia: 
<select id='id_panitia' name='id_panitia'>
	<?php
		$rekap = $this->basic->get_data('master_panitia');
		$no = 0;
		IF($rekap->num_rows())
			{
				foreach ($rekap->result_array() as $R) 
					{ 
						$no++;
						echo "<option value='$R[id_panitia]'>$R[panitia]</option>";
					}
			}
	?>
</select>
(admin berhak merubah jabatan panitia anda sewaktu waktu)
<br>

Satker: 
<select id='id_satker_parent' name='id_satker_parent'>
	<?php
		$rekap = $this->basic->get_data_where('LevelSatker = 2','tmst_satker','UrutanTingkatBanding ASC');
		$no = 0;
		IF($rekap->num_rows())
			{
				foreach ($rekap->result_array() as $R) 
					{ 
						$no++;
						echo "<option value='$R[IdSatker]'>$R[NamaSatker]</option>";
					}
			}
	?>
</select>
<br>

Username: <input type='text' id='username' name='username'><br>
Password: <input type='password' id='password' name='password'><br>
Confirm Password: <input type='password' id='password_confirm' name='password_confirm'><br>

<button id="btn-simpan" type='submit' class="btn btn-outline-success btn-rounded"><i class="fa fa-save"></i> Daftarkan</button>
</form>

<script>
	$("#form_register").submit(function(e) {
		// alert();skip();
        e.preventDefault();
        // var text = $("#btn-simpan").html();
        // $("#btn-simpan").html('<i class="fa fa-spinner fa-spin"></i> Sedang Memproses Data');
        var form_data = new FormData(this);
        $.ajax({
            url: "<?php echo base_url(); ?>register_simpan",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: 'json',
            success: function(json) {
                if (json.status !== true) {
                    alert("Maaf, Pendaftaran Gagal");
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Simpan Data Berhasil',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    location.href = "<?php echo base_url(); ?>"; 
                }
            }
        });
    });	
</script>
