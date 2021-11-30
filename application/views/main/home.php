<div class="content-fixed">
    <div id="slideshow" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#slideshow" data-slide-to="0" class="active"></li>
            <li data-target="#slideshow" data-slide-to="1"></li>
            <li data-target="#slideshow" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner bg-dark">
            <div class="carousel-item active">
                <img src="<?php echo base_url() ?>assets/img/ptwp_2021.jpg" class="d-block  w-100" alt="...">
                <div class="carousel-caption">
                    <!-- <h1 class="text-white">PTWP</h1>
                    <p class="tx-14">Badan Sehat, Fikiran Jernih, Kerja Produktif.</p> -->
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?php echo base_url() ?>assets/img/tenis.jpeg" class="d-block  w-100" alt="...">
                <div class="carousel-caption">
                    <h1 class="text-white">PTWP</h1>
                    <p class="tx-14">Badan Sehat, Pikiran Jernih, Kerja Produktif.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?php echo base_url() ?>assets/img/05.png" class="d-block  w-100" alt="...">
                <div class="carousel-caption">
                    <h1 class="text-white">KETUA MAHKAMAH AGUNG RI</h1>
                    <p class="tx-14">Melakukan Service Pertama Untuk Lapangan Tenis Baru.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?php echo base_url() ?>assets/img/06.png" class="d-block  w-100" alt="...">
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

<div class="divider-text" id="berita_terbaru">
    <h4>Berita Terbaru</h4>
</div>
<div class="content">
    <div class="row">
        <?php foreach ($berita_terbaru->result_array() as $R) { ?>
            <div class="col-sm col-xl-4 mg-t-1 mb-4">
                <div class="media">
                    <img src="<?php echo $R['img'] ?>" class="wd-200 rounded mg-r-20" alt="">
                    <div class="media-body">
                        <a href="<?php echo base_url('main/page/') . $R['alias'] ?>">
                            <h5 class="mg-b-15 tx-inverse"><?php echo $R['judul'] ?></h5>
                        </a>
                        <?php
                        echo $R['intro'] . "...";
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
                <img src="<?php echo base_url() ?>assets/img/pembina_1.png" class="rounded w-100" alt="Responsive image">
            </figure>
            <h4 class="text-center">Prof. Dr. H. Muhammad Syarifuddin, S.H., M.H.</h4>
            <h6 class="text-center">KETUA MA RI/PEMBINA PTWP PUSAT</h6>
        </div>
        <div class="col-sm">
            <figure class="img-caption pos-relative mg-b-0">
                <img src="<?php echo base_url() ?>assets/img/pembina_2.png" class="rounded w-100" alt="Responsive image">
            </figure>
            <h4 class="text-center">Prof. Dr. H. M. Hatta Ali, S.H., M.H.</h4>
            <h6 class="text-center">Mantan Ketua Mahkamah Agung RI / PEMBINA PTWP PUSAT</h6>
        </div>
        <div class="col-sm">
            <figure class="img-caption pos-relative mg-b-0">
                <img src="<?php echo base_url() ?>assets/img/pembina_3.png" class="rounded w-100" alt="Responsive image">
            </figure>
            <h4 class="text-center">Syamsul Ma'arif, S.H., L.L.M, Ph.D.</h4>
            <h6 class="text-center">Ketua PTWP Pusat</h6>
        </div>
        <div class="col-sm">
            <figure class="img-caption pos-relative mg-b-0">
                <img src="<?php echo base_url() ?>assets/img/pembina_4.png" class="rounded w-100" alt="Responsive image">
            </figure>
            <h4 class="text-center">Dr. Prim Haryadi, S.H., M.H.</h4>
            <h6 class="text-center">Ketua Panitia Turnamen PTWP Nasional Tahun 2021</h6>
        </div>
    </div>
</div>