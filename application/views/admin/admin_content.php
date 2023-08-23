<div class="container-fluid">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Log History</h4>
                    <div class="form-group">
                        <input id="demo-input-search2" type="text" placeholder="Search" autocomplete="off">
                    </div>
                    <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="10">
                      <thead>
                          <tr>
                            <th width="75%">Tanggal</th>
                            <th width="20%" data-sort-ignore="true"><center>Action</center></th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php $no=1; foreach($result AS $a) { ?>
                          <tr>
                            <td>
                              <b><?php echo $a->tanggal; ?></b>
                            </td>
                            <td>
                              <center>
                                <a href="<?php echo base_url();?>admin/detail_history/<?php echo $a->tanggal;?>" class="btn btn-small green btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Preview"><i class="fas fa-eye"></i></a>
                              </center>
                            </td>
                          </tr>
                        <?php $no=$no+1; } ?>
                      </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <div class="text-right">
                                        <ul class="pagination">
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
