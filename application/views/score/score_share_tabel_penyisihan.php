<table class='table bg-white w-100'>
    <tr class='text-center align-top font-weight-bold'>
        <td rowspan='2'>Pemain</td>
        <td colspan='3' class='text-center'>Game/Set</td>
        <td rowspan='2' class='text-center'>Point</td>
    </tr>
    <tr class='text-center align-top font-weight-bold'>
        <td>1</td>
        <td>2</td>
        <td>3</td>
    </tr>
    <tr class='align-top'>
        <td>
            <div class='d-flex'>
                <div class="avatar"><img src="<?php echo base_url('assets/img/default.png'); ?>" class="rounded-circle" alt=""></div>
                <div class="pd-l-10">
                    <p class="tx-medium mg-b-0">Pemain 1</p>
                    <small class="tx-12 tx-color-03 mg-b-0">Tim A</small>
                </div>
            </div>
        </td>
        <td id='set1_tim_A' class='text-center'></td>
        <td id='set2_tim_A' class='text-center'></td>
        <td id='set3_tim_A' class='text-center'></td>
        <td class='text-center font-weight-bold' id='point_tim_A'></td>
    </tr>
    <tr class='align-top'>
        <td>
            <div class='d-flex'>
                <div class="avatar"><img src="<?php echo base_url('assets/img/default.png'); ?>" class="rounded-circle" alt=""></div>
                <div class="pd-l-10">
                    <p class="tx-medium mg-b-0">Pemain 1</p>
                    <small class="tx-12 tx-color-03 mg-b-0">Tim A</small>
                </div>
            </div>
        </td>
        <td id='set1_tim_B' class='text-center'></td>
        <td id='set2_tim_B' class='text-center'></td>
        <td id='set3_tim_B' class='text-center'></td>
        <td class='text-center font-weight-bold' id='point_tim_B'></td>
    </tr>
</table>
<style>
    /* dika jadi tukang cat */
    .table{
        margin-bottom: 0;
    }
    .table td{
        line-height: normal;
    }
</style>