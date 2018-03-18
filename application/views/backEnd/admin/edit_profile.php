<section class="content-header">
  <h1>
    <?= $title; ?>
    
  </h1>
  <ol class="breadcrumb">
    <li class="active"><?= $subtitle; ?></li>
  </ol>
</section>

<section class="content">
	<div class="box box-primary">
	<div class="box-header with-border">
    <h3 class="box-title">Edit Profile</h3>
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
          <label for="inputEmail3" class="col-sm-3 control-label">Nama Lengkap</label>

          <div class="col-sm-7">
            <input type="text" name="fullname" class="form-control" value="<?= $fullname; ?>">
          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Username</label>

          <div class="col-sm-7">
            <input type="text" name="username" class="form-control" value="<?= $username; ?>">
          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Email</label>

          <div class="col-sm-7">
            <input type="email" name="email" class="form-control" value="<?= $email; ?>" placeholder="Email">
          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Hp / Telepon</label>

          <div class="col-sm-7">
            <input type="text" name="cellphone" class="form-control" value="<?= $cellphone; ?>">
          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Alamat</label>

          <div class="col-sm-7">
            <textarea name="address" id="" class="form-control"><?= $address; ?></textarea>
          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Foto</label>
          <div class="col-sm-7">

              <?php  
                if(isset($foto))
                {
                  echo '<input type="hidden" name="old_pic" value="'.$foto.'">';
                  echo '<img src="'.base_url().'assets/backEnd/dist/img/'.$foto.'" style="width: 200px;height:250px; margin-top: 10px;margin-bottom: 10px;margin-left: 35%;margin-right: 35%;">';
                }
              ?>

            
            <input type="file" name="foto" class="form-control">

          </div>
        </div>
				<hr>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-3 control-label">Password</label>
          <div class="col-sm-7">
            <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
          	<em>*Masukan kembali password anda untuk konfirmasi perubahan</em>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <a href="<?= base_url(); ?>admin" class="btn btn-default"><< Kembali</a>
      <!--   <button type="button" onclick="">coba</button> -->
        <button type="submit" name="simpan" value="SIMPAN" class="btn btn-info pull-right">Simpan</button>
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