<?php
include('config1.php');
//include('../admin_pinkfresh/config1.php');

if(isset($_GET['edit']) && isset($_GET['id']))
{
	$id=$_GET['id'];
	$sQer="SELECT * FROM degreefiled WHERE degreefiledid='$id'";
	$result=mysql_query($sQer);
	$row=mysql_fetch_array($result);
	 $degreefiledname = $row['degreefiledname'];
     $isactive = $row['isactive'];	 
	
}
if($_SERVER['REQUEST_METHOD']=="POST")


{
	$degreefiledname=$_POST['degreefiledname'];
	$isactive=$_POST['isactive'];	
		if(isset($_GET['edit']))
		{
			$eQer="UPDATE degreefiled SET degreefiledname='$degreefiledname',isactive='$isactive' WHERE degreefiledid='".$_GET['id']."'";
			$result=mysql_query($eQer);
			header("location:degreefiled.php");	
	    }

  else if((isset($_GET['action'])== 'add1')) 
 	{
		
		 $iQer = "INSERT INTO degreefiled (degreefiledname,isactive,createddate)VALUES('$degreefiledname','$isactive',NOW())";
		 $result=mysql_query($iQer);
		 
		  header("location:degreefiled.php");
		

	}	


}


if(isset($_GET['del']) && isset($_GET['block_id']))
{
	$dQer = "DELETE FROM degreefiled WHERE degreefiledid=".$_GET['block_id'];
	mysql_query($dQer);
	header("location:degreefiled.php");
}


?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
       <link href="dist/css/custom.css" rel="stylesheet" type="text/css" />
         <script>	
          function deletemsg() {
    
			if (confirm("Do You Want To Delete This Records ?") == true) {
			} else {
				return false;
			} 
		 }
	 </script>
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      
    <?php include('util/header.php') ?>
      <!-- Left side column. contains the logo and sidebar -->
     <?php include('util/sidebar.php') ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          Manage Degree
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Manage Degree</li>
          </ol>
        </section>

        <!-- Main content -->
        <?php if((isset($_GET['action'])== 'add1')) { 
         ?>
          <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Add Degree</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <tbody>
                      
     <form id="validate-form" class="block-content form" action="#" method="post">
        <div class="_100">
          <p>
            <label for="textfield">Degree Name</label>
            <input id="textfield" name="degreefiledname" class="form-control" type="text"  required/>
          </p>
        </div>
        <div class="_100">
          <p>
            <label for="textfield">Is Active</label>            
			<select  name="isactive" style="border: 1px solid rgb(204, 204, 204); height: 30px;" class="form-control" required>					
                                        <option selected="selected" value="">Please choose</option>
                                        <option value="1">YES</option>
                                        <option value="0">NO</option>
		 </select> 
          </p>
        </div>
        
        <div class="clear"></div>
        <div class="block-actions">
          <ul class="actions-left">
           <li>
              <input type="submit" class="button btn btn-primary btn-block btn-flat" value="Insert" name="ins">
            </li>
            <li>&nbsp;</li>
            <li> <a id="reset-validate-form" href="degreefiled.php" class="button btn btn-primary btn-block btn-flat">Back</a></li>
          </ul>        
        </div>
      </form>
                      
                    </tbody>
                   
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
         <?php }
	      else if((isset($_GET['edit'])== 'edit')) {
		 ?>

            <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                 <h3 class="box-title">Edit Degree</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <tbody>
                      
              <form id="validate-form" class="block-content form" action="#" method="post">
              <div class="_100">
              <p>
            <label for="textfield">Degree Name</label>
            <input id="textfield" name="degreefiledname" class="form-control" type="text" value="<?php echo $row['degreefiledname']; ?>" required/>
          </p>
        </div>
        <div class="_100">
              <p>
            <label for="textfield">Is Active</label>            
			<select name="isactive" class="form-control">
         <option value="">Please Select</option>
           <option value="1" <?php if($isactive=="1"){echo "selected";} ?>>Yes</option>
           <option value="0" <?php if($isactive=="0"){echo "selected";} ?>>No</option>
       </select>
          </p>
        </div>
        
        <div class="clear"></div>
        <div class="block-actions">
          <ul class="actions-left">
            <li>
              <input type="submit" class="button btn btn-primary btn-block btn-flat" value="Update">
            </li>
            <li>&nbsp;</li>
             <li> <a  id="reset-validate-form" href="degreefiled.php" class="button btn btn-primary btn-block btn-flat">Back</a> </li>
          
          </ul>
         
        </div>
      </form>
                      
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
         
      <?php }
	     else
	    {?>
         <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
              <h3 class="box-title">View Degree</h3>
               <div style=" float: right;width: 14.5%;">   <a href="degreefiled.php?action=add1">
                 <input type="submit" class="btn btn-primary btn-block btn-flat" value="Insert">
                 </a>
                 </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-striped">
                    <thead style="color:#367FA9">   
                    <th>Degree Name</th>
					<th>Is Active</th> 
					<th>Created Date</th>					        
                    <th>Action</th>
                    </thead>
                    <tbody>
                      
              <?php 
		    $query1 = "SELECT * FROM degreefiled ORDER BY degreefiledid DESC";
			$result = mysql_query($query1);
			while($row = mysql_fetch_array($result))
				{
				?>

              <tr>
              <td><?php echo $row['degreefiledname'] ;?></td> 
              <td><?php if($row['isactive'] == '0'){
				echo "NO";
				} 
				else if($row['isactive'] == '1'){
				echo "YES";
				} 
				?></td>	 			  
              <td><?php $date = date_create($row['createddate']);
                    echo date_format($date, 'd-m-Y');
                    ?></td>         
               

              <td class="center"><a href="degreefiled.php?edit=edit&id=<?php echo $row['degreefiledid'];?>"><i class="fa fa-edit"></i></a> &nbsp;&nbsp;&nbsp;&nbsp;
			 <a href="degreefiled.php?del='delete' & block_id=<?php echo $row['degreefiledid']; ?>" onClick="return deletemsg();"><i class="fa fa-trash-o"></i></a></td>
            
               </tr>
             <?php } ?>
                      
                    </tbody>
                  
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
        <?php } ?>
    

       
      </div>
     <?php include('util/footer.php') ?>
     
      <div class='control-sidebar-bg'></div>
    </div>

    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <script src="dist/js/demo.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": false,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>

  </body>
</html>
