<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <table border="1">
      <?php
      $start = 0;
      foreach ($kontrak_lemigas as $value) { ?>
                
                <tr>
                  <td><?php echo ++$start; ?></td>
                  <td><?php echo $value->termin_nilai;?></td>
                  <td><?php echo $value->status;?></td>
                </tr>
      <?php } ?>
    </table>
  </body>
</html>
