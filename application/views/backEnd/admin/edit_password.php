<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?= $title; ?>
    <small><?= $subtitle; ?></small>
  </h1>
<!--   <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol> -->
</section>


<section class="content">
	<div class="box box-primary">
	<div class="box-header with-border">
    <h3 class="box-title">Ubah Password</h3>
  </div>

  <div class="callout callout-warning" style="margin: 10px">
    <h4>Warning!</h4>

    <p>Anda harus Login kembali, setelah password di update!</p>
  </div>
  <?= validation_errors('<p style="color:red">','</p>'); ?>
 
     <?php 
      if($this->session->flashdata('success')){
        echo '<div class="alert alert-info alert-message" style="margin-left:10px;margin-right:10px;">';
        echo $this->session->flashdata('success');
        echo '</div>';

      }
    ?>
 
  <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-3 control-label">Password Baru</label>
          <div class="col-sm-7">
            <input type="password" name="newPassword" class="form-control" placeholder="New Password">
          </div>
        </div>
        <hr>
        <div class="form-group">
          <label class="col-sm-3 control-label">Password Lama</label>
          <div class="col-sm-7">
            <input type="password" name="password" class="form-control" placeholder="Password">
          	<em>*Masukan kembali password anda untuk konfirmasi perubahan</em>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer text-center">
        <a href="<?= base_url(); ?>admin" class="btn btn-default" style="margin-right: 10px"><< Kembali</a> 
        <button type="submit" name="submit" value="SUBMIT" class="btn btn-info">Simpan</button>
      </div>
      <!-- /.box-footer -->
    </form>
</div>
</section>

<?php  
  if(@$alertSweet){
    echo $alertSweet;
  }
?>