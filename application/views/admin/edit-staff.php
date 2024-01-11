<style>
  .floatybox {
    display: inline-block;
    width: 123px;
  }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Staff Management
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Staff Management</a></li>
      <li class="active">Edit Staff</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">

      <?php echo validation_errors('<div class="col-md-12">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-check"></i> Failed!</h4>', '</div>
          </div>'); ?>

      <?php if($this->session->flashdata('success')): ?>
        <div class="col-md-12">
          <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                <?php echo $this->session->flashdata('success'); ?>
          </div>
        </div>
      <?php elseif($this->session->flashdata('error')):?>
      <div class="col-md-12">
          <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Failed!</h4>
                <?php echo $this->session->flashdata('error'); ?>
          </div>
        </div>
      <?php endif;?>

      <!-- column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Staff</h3>
          </div>
          <!-- /.box-header -->

          <?php if(isset($content)): ?>
            <?php foreach($content as $cnt): ?>
                <!-- form start -->
                <?php echo form_open_multipart('Staff/update');?>
                  <div class="box-body">

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Full Name</label>
                        <input type="hidden" name="txtid" value="<?php echo $cnt['id'] ?>" class="form-control" placeholder="Full Name">
                        <input type="text" name="txtname" value="<?php echo $cnt['staff_name'] ?>" class="form-control" placeholder="Full Name">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Department</label>
                        <select class="form-control" name="slcdepartment">
                          <option value="">Select</option>
                          <?php
                          if(isset($department))
                          {
                            foreach($department as $cnt1)
                            {
                              if($cnt1['id']==$cnt['department_id'])
                              {
                                print "<option value='".$cnt1['id']."' selected>".$cnt1['department_name']."</option>";
                              }
                              else{
                                print "<option value='".$cnt1['id']."'>".$cnt1['department_name']."</option>";
                              }
                            }
                          } 
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control" name="slcgender">
                          <option value="">Select</option>
                          <?php
                          if($cnt['gender']=='Male')
                          {
                            print '<option value="Male" selected>Male</option>
                                  <option value="Female">Female</option>
                                  <option value="Others">Others</option>';
                          }
                          elseif($cnt['gender']=='Femle')
                          {
                            print '<option value="Male">Male</option>
                                  <option value="Female" selected>Female</option>
                                  <option value="Others">Others</option>';
                          }
                          elseif($cnt['gender']=='Others')
                          {
                            print '<option value="Male">Male</option>
                                  <option value="Female">Female</option>
                                  <option value="Others" selected>Others</option>';
                          }
                          else{
                            print '<option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Others">Others</option>';
                          }
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="txtemail" value="<?php echo $cnt['email'] ?>" class="form-control" placeholder="Email" readonly>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Mobile</label>
                        <input type="text" name="txtmobile" value="<?php echo $cnt['mobile'] ?>" class="form-control" placeholder="Mobile" readonly>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Photo</label>
                        <input type="file" name="filephoto" class="form-control">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" name="txtdob" value="<?php echo $cnt['dob'] ?>" class="form-control" placeholder="DOB">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Date of Joining</label>
                        <input type="date" name="txtdoj" value="<?php echo $cnt['doj'] ?>" class="form-control" placeholder="DOJ">
                      </div>
                    </div>
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>City</label>
                        <input type="text" name="txtcity" value="<?php echo $cnt['city'] ?>" class="form-control" placeholder="City">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>State</label>
                        <input type="text" name="txtstate" value="<?php echo $cnt['state'] ?>" class="form-control" placeholder="State">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Country</label>
                        <select class="form-control" name="slccountry">
                          <option value="">Select</option>
                          <?php
                            if(isset($country))
                            {
                              foreach ($country as $cnt1)
                              {
                                if($cnt1['country_name']==$cnt['country'])
                                {
                                  print "<option value='".$cnt1['country_name']."' selected>".$cnt1['country_name']."</option>";
                                }
                                else{
                                  print "<option value='".$cnt1['country_name']."'>".$cnt1['country_name']."</option>";
                                }
                                
                              }
                            }
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" name="txtaddress"><?php echo $cnt['address'] ?></textarea>
                      </div>
                    </div>
                    
                    <!-- Placeholder for SSN Number -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>SSS Number</label>
                        <input type="text" name="txtsss" value="<?php echo $cnt['sss_number'] ?>" class="form-control" placeholder="SSS Number">
                      </div>
                    </div>



                    <!-- Placeholder for PAG-IBIG Number -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>PAG-IBIG Number</label>
                        <input type="text" name="txtpagibig" value="<?php echo $cnt['pag_ibig_number'] ?>" class="form-control" placeholder="PAG-IBIG Number">
                      </div>
                    </div>

                    <!-- Placeholder for TIN Number -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>TIN Number</label>
                        <input type="text" name="txttin" value="<?php echo $cnt['tin_number'] ?>" class="form-control" placeholder="TIN Number">
                      </div>
                    </div>

                    <!-- Placeholder for PhilHealth Number -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>PhilHealth Number</label>
                        <input type="text" name="txtph" value="<?php echo $cnt['phil_health'] ?>" class="form-control" placeholder="PhilHealth Number">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>SSS Contribution</label>
                        <input type="text" name="txtssscontrib" value="<?php echo $cnt['sss_contrib']; ?>" class="form-control" placeholder="SSS Contribution">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Pag-IBIG Contribution</label>
                        <input type="text" name="txtpagibigcontrib" value="<?php echo $cnt['pag_ibig_contrib']; ?>" class="form-control" placeholder="Pag-IBIG Contribution">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>TIN Contribution</label>
                        <input type="text" name="txttincontrib" value="<?php echo $cnt['tin_contrib']; ?>" class="form-control" placeholder="TIN Contribution">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>PhilHealth Contribution</label>
                        <input type="text" name="txtphcontrib" value="<?php echo $cnt['phil_health_contrib']; ?>" class="form-control" placeholder="PhilHealth Contribution">
                      </div>
                    </div>

                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-success pull-right">Submit</button>
                  </div>
                </form>
              <?php endforeach; ?>
          <?php endif; ?>
        </div>
        <!-- /.box -->
      </div>
      <!--/.col (left) -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
