<div class="content content-fixed">
    <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                        <li class="breadcrumb-item"><a href="#">Berita</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $judul; ?></li>
                    </ol>
                </nav>
                <h4 class="mg-b-0"><?php echo $judul; ?></h4>
            </div>
            <div class="search-form mg-t-20 mg-sm-t-0">
                <input type="search" class="form-control" placeholder="Pencarian Berita">
                <button class="btn" type="button"><i data-feather="search"></i></button>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <div class="row row-sm mg-b-25">
                        <?php foreach ($list_berita->result_array() as $R) {
                            $intro = substr(strip_tags($R['isi']), 0, 50);
                            // $intro = substr($R['isi'], 0, 200);
                            preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $R['isi'], $img); //BUAT DAPETIN GAMBAR PERTAMA DALAM ISI
                            if (empty($img)) {
                                $gambar = base_url('assets/img/gambar.jpg');
                                // $gambar = base_url('assets/img/no_images.png');
                            } else {
                                if (filter_var($img['src'], FILTER_VALIDATE_URL))
                                    $gambar = $img['src'];
                                else
                                    $gambar = base_url($img['src']);
                            }
                        ?>
                            <div class="col-md-4 mg-t-20">
                                <div class="card card-event" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                                    <div class="pos-relative overflow-hidden rounded">
                                        <div class="marker-icon marker-primary pos-absolute t-0 l-0"><i data-feather="rss"></i></div>
                                        <img src="<?php echo $gambar; ?>" class="card-img-top" alt="thumbnail">
                                    </div>
                                    <div class="card-body tx-13">
                                        <h5><a href="<?php echo base_url('main/page/') . $R['alias'] ?>"><?php echo $R['judul'] ?></a></h5>
                                        <p class="mg-b-0 text-justify"><?php echo $intro ?> ...</p>
                                        <span class="tx-12 h6">Tanggal Berita : <?php echo format_tanggal('ddmmmmyyyyhis', $R['date_created']) ?></span>
                                    </div><!-- card-body -->
                                    <div class="card-footer tx-13">
                                        <span class="tx-color-03">Dilihat <?php echo $R['total_dilihat']; ?>x</span>
                                        <a class="btn btn-xs btn-primary" href="<?php echo base_url('main/page/') . $R['alias'] ?>">Selengkapnya</a>
                                    </div><!-- card-footer -->
                                </div><!-- card -->
                            </div><!-- col -->
                        <?php } ?>
                    </div><!-- row -->
                </div><!-- col -->
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- content -->
</div>