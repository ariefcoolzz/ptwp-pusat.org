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
                        <?php foreach ($berita_ptwp_pusat->result_array() as $R) {
                            $intro = substr(strip_tags($R['isi']), 0, 200);
                            // $intro = substr($R['isi'], 0, 200);

                            if ($R['img'] == "") {
                                $gambar = base_url('assets/img/gambar.jpg');
                                // $gambar = base_url('assets/img/no_images.png');
                            } else {
                                if (filter_var($R['img'], FILTER_VALIDATE_URL))
                                    $gambar = $R['img'];
                                else
                                    $gambar = base_url($R['img']);
                            }
                        ?>
                            <div class="col-md-4 mg-t-20">
                                <div class="card card-event">
                                    <img src="<?php echo $gambar; ?>" class="card-img-top" alt="thumbnail">
                                    <div class="card-body tx-13">
                                        <h5><a href="<?php echo base_url('main/page/') . $R['alias'] ?>"><?php echo $R['judul'] ?></a></h5>
                                        <p class="mg-b-0 text-justify"><?php echo $intro ?> .... </p>
                                        <span class="tx-12 h6">Tanggal Berita : <?php echo format_tanggal('wddmmmmyyyyhis', $R['date_created']) ?></span>
                                    </div><!-- card-body -->
                                    <div class="card-footer tx-13">
                                        <span class="tx-color-03">xxx Dilihat</span>
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