<div class="content-fixed">
    <div id="slideshow" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#slideshow" data-slide-to="0" class="active"></li>
            <li data-target="#slideshow" data-slide-to="1"></li>
            <li data-target="#slideshow" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner bg-dark">
            <div class="carousel-item active">
                <img src="<?php echo base_url() ?>assets/img/ptwp_2021.jpeg" class="d-block ht-600 w-100" alt="...">
                <div class="carousel-caption">
                    <h1 class="text-white">PTWP</h1>
                    <p class="tx-14">Badan Sehat, Fikiran Jernih, Kerja Produktif.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?php echo base_url() ?>assets/img/tenis.jpeg" class="d-block ht-600 w-100" alt="...">
                <div class="carousel-caption">
                    <h1 class="text-white">PTWP</h1>
                    <p class="tx-14">Badan Sehat, Fikiran Jernih, Kerja Produktif.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?php echo base_url() ?>assets/img/05.png" class="d-block ht-600 w-100" alt="...">
                <div class="carousel-caption">
                    <h1 class="text-white">KETUA MAHKAMAH AGUNG RI</h1>
                    <p class="tx-14">Melakukan Service Pertama Untuk Lapangan Tenis Baru.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?php echo base_url() ?>assets/img/06.png" class="d-block ht-600 w-100" alt="...">
                <div class="carousel-caption">
                    <h1 class="text-white">KETUA MAHKAMAH AGUNG RI</h1>
                    <p class="tx-14">Melakukan Service Pertama Untuk Lapangan Tenis Baru.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#slideshow" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"><i data-feather="chevron-left"></i></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#slideshow" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"><i data-feather="chevron-right"></i></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div><!-- content -->

<div class="divider-text">
    <h4>Berita Terbaru</h4>
</div>
<div class="content">
    <div class="row">
        <?php foreach($berita_terbaru->result_array() as $R) { ?>
        <div class="col-sm col-xl-4 mg-t-1 mb-4">
            <div class="media">
                <img src="<?php echo $R['img'] ?>" class="wd-200 rounded mg-r-20" alt="">
                <div class="media-body">
                    <a href="<?php echo base_url('main/page/').$R['alias'] ?>"><h5 class="mg-b-15 tx-inverse"><?php echo $R['judul'] ?></h5></a>
                    <?php 
                    echo $R['intro']."...";
                    ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<div class="divider-text">
    <h4>Pengurus PTWP Pusat</h4>
</div>
<div class="content">
    <div class="row">
        <div class="col-sm">
            <figure class="img-caption pos-relative mg-b-0">
                <img src="<?php echo base_url() ?>assets/img/01.jpg" class="rounded w-100" alt="Responsive image">
                <figcaption class="pos-absolute a-0 wd-100p pd-20 d-flex flex-column justify-content-center bg-white-9 transition-base op-0">
                    <h6 class="tx-inverse tx-semibold mg-b-20 text-center">Ketua Mahkamah Agung RI</h6>
                </figcaption>
            </figure>
            <h4 class="text-center">Prof. Dr. H. Muhammad Syarifuddin, S.H., M.H.</h4>
            <h6 class="text-center">KETUA MA RI/PEMBINA PTWP PUSAT</h6>
        </div>
        <div class="col-sm">
            <figure class="img-caption pos-relative mg-b-0">
                <img src="<?php echo base_url() ?>assets/img/02.jpeg" class="rounded ht-250 w-100" alt="Responsive image">
                <figcaption class="pos-absolute a-0 wd-100p pd-20 d-flex flex-column justify-content-center bg-white-9 transition-base op-0">
                    <h6 class="tx-inverse tx-semibold mg-b-20 text-center">Mantan Ketua Mahkamah Agung RI</h6>
                </figcaption>
            </figure>
            <h4 class="text-center">Prof. Dr. H. Muhammad Syarifuddin, S.H., M.H.</h4>
            <h6 class="text-center">KETUA MA RI/PEMBINA PTWP PUSAT</h6>
        </div>
        <div class="col-sm">
            <figure class="img-caption pos-relative mg-b-0">
                <img src="<?php echo base_url() ?>assets/img/03.jpg" class="rounded ht-250 w-100" alt="Responsive image">
                <figcaption class="pos-absolute a-0 wd-100p pd-20 d-flex flex-column justify-content-center bg-white-9 transition-base op-0">
                    <h6 class="tx-inverse tx-semibold mg-b-20 text-center">Ketua PTWP Pusat</h6>
                </figcaption>
            </figure>
            <h4 class="text-center">Prof. Dr. H. Muhammad Syarifuddin, S.H., M.H.</h4>
            <h6 class="text-center">KETUA MA RI/PEMBINA PTWP PUSAT</h6>
        </div>
        <div class="col-sm">
            <figure class="img-caption pos-relative mg-b-0">
                <img src="<?php echo base_url() ?>assets/img/04.jpg" class="rounded ht-250 w-100" alt="Responsive image">
                <figcaption class="pos-absolute a-0 wd-100p pd-20 d-flex flex-column justify-content-center bg-white-9 transition-base op-0">
                    <h6 class="tx-inverse tx-semibold mg-b-20 text-center">Ketua Panitia Turnamen PTWP Nasional Tahun 2021</h6>
                </figcaption>
            </figure>
            <h4 class="text-center">Prof. Dr. H. Muhammad Syarifuddin, S.H., M.H.</h4>
            <h6 class="text-center">KETUA MA RI/PEMBINA PTWP PUSAT</h6>
        </div>
    </div>
</div>