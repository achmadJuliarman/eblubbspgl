<div class="container-fluid">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Log History</h4>
                    <div class="form-group">
                        <input id="demo-input-search2" type="text" placeholder="Search" autocomplete="off">
                    </div>
                    <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="20">
                      <thead>
                          <tr>
                            <th width="5%"><center>No</center></th>
                            <th><center>Created</center></th>
                            <th><center>Username</center></th>
                            <th><center>Description</center></th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php $no=1; foreach($result AS $a) { ?>
                          <tr>
                            <td><center><?php echo $no; ?></center></td>
                            <td>
                              <span class="label label-table label-success"><?php echo $a->created_at; ?></span>
                            </td>
                            <td>
                              <?php echo $a->username; ?><br>
                            </td>
                            <td>
                              <?php echo "Event : ".$a->event." Table : ".$a->table_name;; ?><br>
                              <span class="label label-table label-warning"><?php echo $a->description; ?></span>
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
