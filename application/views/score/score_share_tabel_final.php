<table class='table table-bordered w-100 font-weight-bold' >
    <tr>
        <td>
            <div class='d-flex'>
                <img src="<?php echo base_url('assets/img/tennisball.gif'); ?>" class="wd-50" alt="">
                <div class="pd-l-10">
                    <p class="tx-medium mg-b-0" id='nama_pemain_tim_A'></p>
                    <small class="tx-12  mg-b-0" id='nama_satker_A'></small>
                </div>
            </div>
        </td>
        <td class='text-center align-middle' id='menang_tim_A'></td>
        <td class='text-center align-middle'>
            <div class='template_non_final'>
                <span class='set1_tim_A'></span> 
            </div>
            <div class='template_final'>
                <span class='set1_tim_A'></span> 
                | <span class='set2_tim_A'></span> 
            </div>
        </td>
        <td class='text-center align-middle' id='point_tim_A'></td>
    </tr>
    <tr class='align-top'>
        <td>
            <div class='d-flex'>
                <img src="<?php echo base_url('assets/img/tennisball.gif'); ?>" class="wd-50" alt="">
                <div class="pd-l-10">
                    <p class="tx-medium mg-b-0" id='nama_pemain_tim_B'></p>
                    <small class="tx-12  mg-b-0" id='nama_satker_B'></small>
                </div>
            </div>
        </td>
        <td class='text-center align-middle' id='menang_tim_B'></td>
        <td class='text-center align-middle'>
            <div class='template_non_final'>
                <span class='set1_tim_B'></span> 
            </div>
            <div class='template_final'>
                <span class='set1_tim_B'></span> 
                | <span class='set2_tim_B'></span> 
            </div>
        </td>
        <td class='text-center align-middle' id='point_tim_B'></td>
    </tr>
</table>

<style>
    /* dika jadi tukang cat */
    .table {
        margin-bottom: 0;
    }

    .table td {
        line-height: normal;
    }
</style>