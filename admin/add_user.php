<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0){
  header('location:index.php');
}
else{
  if(isset($_POST['submit'])){
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $mobile=$_POST['mobile'];
    $add1=$_POST['add1'];
    $add2=$_POST['add2'];
    $sql="INSERT INTO  user_info(first_name, last_name, email, password, mobile, address1, address2) VALUES(:fname, :lname, :email, :password, :mobile, :add1, :add2)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':fname',$fname,PDO::PARAM_STR);
    $query->bindParam(':lname',$lname,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':password',$password,PDO::PARAM_STR);
    $query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
    $query->bindParam(':add1',$add1,PDO::PARAM_STR);
    $query->bindParam(':add2',$add2,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId){
      $msg="Your info submitted successfully";
    }
    else {
      $error="Something went wrong. Please try again";
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>APNG Online Shop | User Management</title>

  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-social.css">
  <link rel="stylesheet" href="css/bootstrap-select.css">
  <link rel="stylesheet" href="css/fileinput.min.css">
  <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
  <link rel="stylesheet" href="css/style.css">

  <style>
    .errorWrap {
      padding: 10px;
      margin: 0 0 20px 0;
      background: #fff;
      border-left: 4px solid #dd3d36;
      -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
      box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    }
     .succWrap{
      padding: 10px;
      margin: 0 0 20px 0;
      background: #fff;
      border-left: 4px solid #5cb85c;
      -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
      box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    }
  </style>
  <script language="javascript">
    function isNumberKey(evt){
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode!=46){
        return false;
      }
      return true;
    }
  </script>
</head>

<body>
  <?php include('includes/header.php');?>
  <div class="ts-main-content">
    <?php include('includes/leftbar.php');?>
    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h2 class="page-title">Add Customer</h2>
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-heading">Basic Info</div>
                  <?php
                  if($error){?>
                    <div class="errorWrap">
                      <strong>ERROR</strong>:<?php echo htmlentities($error); ?>
                    </div><?php
                  }
                  else if($msg){?>
                    <div class="succWrap">
                      <strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?>
                    </div><?php
                  }?>
                  <div class="panel-body">
                    <form method="post" class="form-horizontal" enctype="multipart/form-data">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">First Name<span style="color:red">*</span></label>
                        <div class="col-sm-4">
                          <input type="text" name="fname" class="form-control" required>
                        </div>
                        <label class="col-sm-2 control-label">Last Name<span style="color:red">*</span></label>
                        <div class="col-sm-4">
                          <input type="text" name="lname" class="form-control" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Email id </label>
                        <div class="col-sm-4">
                          <input type="email" name="email" class="form-control" required>
                        </div>
                        <label class="col-sm-2 control-label">Password<span style="color:red">*</span></label>
                        <div class="col-sm-4">
                          <input type="text" name="password" class="form-control" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Mobile Number </label>
                        <div class="col-sm-4">
                          <input type="text" name="mobile" class="form-control" required>
                        </div>
                      </div>
                      <div class="hr-dashed"></div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Address 1</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" name="add1" required></textarea>
                        </div>
                      </div>
                      <div class="hr-dashed"></div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Address 2<span style="color:red">*</span></label>
                        <div class="col-sm-10">
                          <textarea class="form-control" name="add2" required> </textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                          <button class="btn btn-default" type="reset">Cancel</button>
                          <button class="btn btn-primary" name="submit" type="submit">Save changes</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap-select.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap.min.js"></script>
  <script src="js/Chart.min.js"></script>
  <script src="js/fileinput.js"></script>
  <script src="js/chartData.js"></script>
  <script src="js/main.js"></script>
</body>
</html>
<?php } ?>