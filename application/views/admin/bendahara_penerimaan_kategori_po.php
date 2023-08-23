<div class="container-fluid">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="row">
                      <?php foreach ($result AS $a) { ?>
                        <div class="col s12 m6">
                            <div class="card <?php echo $a->warna;?>">
                                <div class="card-content white-text">
                                  <center>
                                    <div class="center-align white-text display-6">
                                        <i class="<?php echo $a->icon;?>"></i>
                                    </div>
                                    <p><?php echo $a->keterangan; ?></p>
                                  </center>
                                </div>
                                <div class="card-action">
                                  <center>
                                    <a href="<?php echo base_url(); ?>bendahara_penerimaan/input_po/<?php echo $a->id_kategori; ?>" class="waves-effect <?php echo $a->warna;?> waves-light btn-large"><i class="material-icons right">send</i>Tambah Data</a>
                                  </center>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
