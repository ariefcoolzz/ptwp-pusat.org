<?php if (isset($konten['cat_id'])) { ?>
    <div class="content content-fixed">
        <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
            <div class="d-sm-flex align-items-center justify-content-between">
                <div>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                            <li class="breadcrumb-item"><a href="#"><?php if ($konten['cat_id'] == '0') {
                                                                        echo "Halaman";
                                                                    } else echo "Berita"; ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $judul; ?></li>
                        </ol>
                    </nav>

                    <div class="pt-0 pb-4"><small class="fw-bold">
                            <?php if ($konten['date_created'] !== '0000-00-00 00:00:00') echo " <b>" . $konten['nama_creator'] . "</b>, " . format_tanggal('ddmmmmyyyyhis', $konten['date_created'] . "-") ?> || Dilihat <?php echo $konten['total_dilihat'] ?> kali</small></div>
                    <h4><?php echo $judul; ?></h4>
                </div>
            </div>
        </div>
        <div class="content-bd">
            <div class="container">
                <div class="watermark mg-0">
                    <?php
                    $isi = str_replace('src="file_upload', 'src="http://ptwp-pusat.org/file_upload', $konten['isi']);
                    echo $isi;
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="content content-fixed">
        <div class="content-bd">
            <div class="container">
                <div class="watermark mg-0 text-center">
                    <?php
                    $isi = str_replace('src="file_upload', 'src="http://ptwp-pusat.org/file_upload', $konten['isi']);
                    echo $isi;
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>