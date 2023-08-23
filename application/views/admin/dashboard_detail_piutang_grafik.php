<div class="container-fluid">
    <div class="row">
      <div class="col s12 l12">
          <div class="card">
              <div class="card-content">

                  <!-- Sales Summery -->
                  <div class="p-t-20">
                      <div class="row">
                          <div class="col s12">
                              <div id="container_piutang" style="height: 450px;"></div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
          <table id="datatable_piutang" hidden>
            <thead>
                <tr>
                    <th>Jenis Piutang</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                    <td>Lancar</td>
                    <td><?php if($lancar->total_piutang == 0) { echo 0;} else { echo $lancar->total_piutang; } ?></td>
                </tr>
                <tr>
                    <td>Kurang Lancar</td>
                    <td><?php if($kurang->total_piutang == 0) { echo 0;} else { echo $kurang->total_piutang; } ?></td>
                </tr>
                <tr>
                    <td>Diragukan</td>
                    <td><?php if($diragukan->total_piutang == 0) { echo 0;} else { echo $diragukan->total_piutang; } ?></td>
                </tr>
                <tr>
                    <td>Macet</td>
                    <td><?php if($macet->total_piutang == 0) { echo 0;} else { echo $macet->total_piutang; } ?></td>
                </tr>
            </tbody>
          </table>
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="card-title">Detail Informasi</h5>
                            <h6 class="card-subtitle">Data Piutang</h6>
                        </div>
                    </div>
                    <div class="table-responsive m-b-20">
                      <table class="table table-bordered table-hover toggle-circle">
                        <thead>
                            <tr>
                                <th>KP3</th>
                                <th>Lancar</th>
                                <th>Kurang Lancar</th>
                                <th>Diragukan</th>
                                <th>Macet</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($pelaksana_layanan as $a) { ?>
                            <tr>
                                <td><a href="<?php echo base_url(); ?>pimpinan/detail_piutang/<?php echo $a->id_rumah_layanan; ?>"><?php echo $a->nama; ?></a></td>
                                <td>
                                  <?php
                                  foreach ($result_lancar as $rl)
                                  {
                                    if($rl->id_rumah_layanan == $a->id_rumah_layanan)
                                    {
                                       if($rl->total_piutang == 0) { echo "-";} else { echo "Rp. ".number_format($rl->total_piutang,0,'','.' ).",-"; }
                                    }
                                  }
                                  ?>
                                </td>
                                <td>
                                  <?php
                                  foreach ($result_kurang as $rk)
                                  {
                                    if($rk->id_rumah_layanan == $a->id_rumah_layanan)
                                    {
                                       if($rk->total_piutang == 0) { echo "-";} else { echo "Rp. ".number_format($rk->total_piutang,0,'','.' ).",-"; }
                                    }
                                  }
                                  ?>
                                </td>
                                <td>
                                  <?php
                                  foreach ($result_diragukan as $rd)
                                  {
                                    if($rd->id_rumah_layanan == $a->id_rumah_layanan)
                                    {
                                       if($rd->total_piutang == 0) { echo "-";} else { echo "Rp. ".number_format($rd->total_piutang,0,'','.' ).",-"; }
                                    }
                                  }
                                  ?>
                                </td>
                                <td>
                                  <?php
                                  foreach ($result_macet as $rm)
                                  {
                                    if($rm->id_rumah_layanan == $a->id_rumah_layanan)
                                    {
                                       if($rm->total_piutang == 0) { echo "-";} else { echo "Rp. ".number_format($rm->total_piutang,0,'','.' ).",-"; }
                                    }
                                  }
                                  ?>
                                </td>
                            </tr>
                          <?php } ?>
                        </tbody>
                        <?php $total = $lancar->total_piutang + $kurang->total_piutang + $diragukan->total_piutang + $macet->total_piutang; ?>
                        <tfoot>
                            <tr>
                                <th>SUB TOTAL</th>
                                <th><?php echo "Rp. ".number_format($lancar->total_piutang,0,'','.' ).",-"; ?></th>
                                <th><?php echo "Rp. ".number_format($kurang->total_piutang,0,'','.' ).",-"; ?></th>
                                <th><?php echo "Rp. ".number_format($diragukan->total_piutang,0,'','.' ).",-"; ?></th>
                                <th><?php echo "Rp. ".number_format($macet->total_piutang,0,'','.' ).",-"; ?></th>
                            </tr>
                            <tr>
                                <th>TOTAL</th>
                                <th colspan="4" style="text-align:center;"><?php echo "Rp. ".number_format($total,0,'','.' ).",-"; ?></th>
                            </tr>
                        </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
