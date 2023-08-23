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
      foreach ($datalist as $value) { ?>
                <tr>
                  <td><?php echo ++$start ?></td>
                  <td><?php echo $value->unit_nama;?></td>
                  <td><?php echo $value->mak_nama;?></td>
                  <td><?php echo $value->mak_kode;?></td>
                  <td><?php echo $value->mak_nilai; ?></td>
                </tr>
      <?php } ?>
    </table>
  </body>
</html>
