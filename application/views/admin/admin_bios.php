<div id="main">
  <div class="row">
    <div class="col s12">
      <div class="container">
        <div class="section section-data-tables">
          <div class="card">
            <div class="card-content">
              <div class="row">
                <?php if ($satker == 2) { ?>
                  <div class="col s6">
                    <a href="<?php echo base_url(); ?>admin/api_bbspgl_harian" class="btn btn-success btn-with-icon btn-block rounded-5 modal-trigger" id="harian"><i class="far fa-file-alt"></i> Sync Bios Harian</a>
                  </div>
                  <div class="col s6">
                    <a href="<?php echo base_url(); ?>admin/api_bbspgl_bulanan" class="btn btn-success btn-with-icon btn-block rounded-5 modal-trigger" id="bulanan"><i class="far fa-file-alt"></i> Sync Bios Bulanan</a>
                  </div>
                <?php } ?>
              </div>
              <div class="row">
                <div class="col s12">
                  <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
                    <!-- <table id="page-length-option" class="responsive-table" width="100%"> -->
                    <thead>
                      <tr>
                        <th>Webservices</th>
                        <th>Periode</th>
                        <th>Last Status</th>
                        <th>Last Updated</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($result as $r) { ?>
                        <tr>
                          <td>
                            <?php echo $r->webservice; ?>
                          </td>
                          <td><?php echo $r->periode; ?></td>
                          <td><?php echo $r->last_status; ?></td>
                          <td><?php echo $r->last_updated; ?></td>
                        </tr>
                      <?php
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
