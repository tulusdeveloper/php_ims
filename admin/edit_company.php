
<?php
include "header.php";
include "../user/connection.php";
$id=$_GET["id"];
$company_name="";

$res=mysqli_query($link,"select * from company_name where id=$id");
while($row=mysqli_fetch_array($res))
{
   $company_name=$row["company_name"];
}
?>

<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="demo.php" class="tip-bottom"><i class="icon-home"></i>
            Edit Company</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
        <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Edit Company</h5>
        </div>
        <div class="widget-content nopadding">
          <form name="form1" action="" method="post" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">Company Name :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Company name" name="companyname" value="<?php echo $company_name; ?>" />
              </div>
            </div>
            

            <div class="form-actions">
              <button type="submit" name="submit1" class="btn btn-primary">Update</button>
            </div>
            <div class="alert alert-success" id="success" style="display:none;">
                Company Updated Successfully.
            </div>

          </form>
        </div>
        </div>
        
            
     </div>
        </div>

    </div>
</div>

<?php
if(isset($_POST["submit1"]))
{
    mysqli_query($link,"update company_name set company_name='$_POST[companyname]' where id=$id") or die(mysqli_error($link));
    ?>
    <script type="text/javascript"> 
        document.getElementById("success").style.display="block";
        //start of autorefresh
        setTimeout(function(){
            window.location="add_company.php";
        },500);
        // End autorefresh
    </script>
    <?php
}
?>

<?php
include "footer.php";
?>

