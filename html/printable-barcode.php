<style>
  .list-group {display: none;}
  .navbar {display: none;}

  .printable-ticket
  {
    width: 15cm;
    min-height: 10.5cm;
    border-style: solid;
    border-width: 1px;
    position: absolute;
    top: 0;
    left: 1;
  }

  .container
  {
    width: 15cm;
  }

  .barcode
  {
    position: absolute;
    top: 100px;
    left: 1;
    width: calc(15cm - 3px);
  }

  .panel.desc
  {
    position: absolute;
    bottom: 0;
    left: 1;
    width: calc(15cm - 3px);
  }

  div.branding
  {
    position: absolute;
    top: 1;
    left: 1;
    width: 15cm;
  }

  .barcode-img
  {
    position: absolute;
    top: -95px;
    right: 1;
  }
</style>

<div class='printable-ticket'>
  <br><br>
  <div class='container'>
    <div class='branding'>
      <div class='row'>
        <div class='col-md-4'>
          <img src='../plugins/device-tracker/img/logo.png' width='190px'>
        </div>
        <div class='col-md-8'>
        </div>
      </div>
    </div>
    <div class='panel panel-default barcode'>
      <div class='panel-heading'>Track this repair</div>
      <div class='panel-body'>
        <div class='col-md-3'>
          <img src='../plugins/device-tracker/img/scan.png' width='102px'>
        </div>
        <div class='col-md-8'>
          <img class='pull-right barcode-img' src='../plugins/device-tracker/barcode.php?text=<?php print $barcode; ?>&size=80'>
        </div>
      </div>
    </div>
  </div>
  <div class='panel panel-default desc'>
    <div class='panel-heading'>Job Description</div>
    <div class='panel-body'>
      <?php print $the_order['Job_Desc']; ?>
    </div>
  </div>
</div>

<script>window.print(); </script>
