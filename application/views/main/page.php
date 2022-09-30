<div class="content content-fixed">
    <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                        <li class="breadcrumb-item"><a href="#">Profil</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $judul; ?></li>
                    </ol>
                </nav>
                <div class="pt-0 pb-4"><small class="fw-bold">
                        <?php if ($konten['date_created'] !== '0000-00-00 00:00:00') echo "Tanggal Berita : " . format_tanggal('wddmmmmyyyyhis', $konten['date_created'] . "-") ?> Dilihat <?php echo $konten['total_dilihat'] ?> kali</small></div>
                <h4><?php echo $judul; ?></h4>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="row">
            <div class="col-sm"></div>
            <div class="watermark col-sm-8"> <?php echo $konten['isi']; ?></div>
            <div class="col-sm"></div>
        </div>
    </div>
</div>