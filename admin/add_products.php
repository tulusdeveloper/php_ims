
<?php
include "header.php";
include "../user/connection.php";
?>

<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="add_products.php" class="tip-bottom"><i class="icon-home"></i>
            Products</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
     <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Add New Products</h5>
        </div>
        <div class="widget-content nopadding">
          <form name="form1" action="" method="post" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">Select Company:</label>
              <div class="controls">
                <select class="span8" name="company_name">
                    <?php
                    $res=mysqli_query($link,"select * from company_name");
                    while($row=mysqli_fetch_array($res))
                    {
                        echo "<option>";
                        echo $row["company_name"];
                        echo "</option>";
                    }
                    ?>
                </select>
                </div>
            </div>

            <div class="control-group">
              <label class="control-label">Enter Product:</label>
              <div class="controls">
                    <input type="text" name="product_name" class="span11" placeholder="Enter Product Name">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Select Unit:</label>
              <div class="controls">
                <select class="span8" name="unit">
                    <?php
                    $res=mysqli_query($link,"select * from units");
                    while($row=mysqli_fetch_array($res))
                    {
                        echo "<option>";
                        echo $row["unit"];
                        echo "</option>";
                    }
                    ?>
                </select>
                </div>
            </div>

            <div class="control-group">
              <label class="control-label">Enter Packing Size:</label>
              <div class="controls">
                    <input type="text" name="packing_size" class="span11" placeholder="Enter Packing Size">
              </div>
            </div>
           
            <div class="alert alert-danger" id="error" style="display:none;">
                This Product Already Exist! Please Try Another.
            </div>
           

            <div class="form-actions">
              <button type="submit" name="submit1" class="btn btn-success">Save</button>
            </div>
            <div class="alert alert-success" id="success" style="display:none;">
                Product Added Successfully.
            </div>

          </form>
        </div>
        </div>
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Company Name</th>
                  <th>Product Name</th>
                  <th>Unit</th>
                  <th>Packing Size</th>
                  <th style="color:green;">EDIT</th>
                  <th style="color:red;">DELETE</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $res=mysqli_query($link,"select * from product");
                while($row=mysqli_fetch_array($res))
                {
                    ?>
                    <tr>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo $row["company_name"]; ?></td>
                        <td><?php echo $row["product_name"]; ?></td>
                        <td><?php echo $row["unit"]; ?></td>
                        <td><?php echo $row["packing_size"]; ?></td>
                        <td><center><a class="btn btn-success" href="edit_products.php?id=<?php echo $row["id"]; ?>">Edit</a></center></td>
                        <td><center><a class="btn btn-danger" href="delete_products.php?id=<?php echo $row["id"]; ?>">Delete</a></center></td>
                </tr>
                    <?php
                }
                ?>
                
                
              </tbody>
            </table>
          </div>
     </div>
        </div>

    </div>
</div>

<!--end-main-container-part-->

<?php
if(isset($_POST["submit1"]))
{
    $count=0;
    $res=mysqli_query($link,"select * from product where company_name='$_POST[company_name]' && product_name='$_POST[product_name]' && unit='$_POST[unit]' && packing_size='$_POST[packing_size]'") or die(mysqli_error($link));
    $count=mysqli_num_rows($res);

    if($count>0)
    {
        ?>
        <script type="text/javascript">
            document.getElementById("success").style.display="none";
            document.getElementById("error").style.display="block";
        </script>
        <?php
    }
    else{
        mysqli_query($link,"insert into product value(NULL,'$_POST[company_name]','$_POST[product_name]','$_POST[unit]','$_POST[packing_size]')") or die(mysqli_error($link));

        ?>
        <script type="text/javascript"> 
            document.getElementById("error").style.display="none";
            document.getElementById("success").style.display="block";
            //start of autorefresh
            setTimeout(function(){
                window.location.href=window.location.href;
            },100);
            // End autorefresh
        </script>
        <?php
    }
}
?>

<?php
include "footer.php";
?>

