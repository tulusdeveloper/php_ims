
<?php
include "header.php";
include "../user/connection.php";
?>

<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="purchase_master.php" class="tip-bottom"><i class="icon-home"></i>
            Add New Purchase</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
     <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Add New Purchase</h5>
        </div>
        <div class="widget-content nopadding">
          <form name="form1" action="" method="post" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">Select Company:</label>
              <div class="controls">
                <select class="span8" name="company_name" id="company_name">
                    <option>Select</option>
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

            <div class="control-group" id="product_name">
              <label class="control-label">Select Product Name:</label>
              <div class="controls" id="product_name">
                <select class="span11">
                    <option>Select</option>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Select Unit:</label>
              <div class="controls" id="unit">
                <select class="span8">
                    <option>Select</option>
                </select>
                </div>
            </div>

            <div class="control-group">
              <label class="control-label">Enter Packing Size:</label>
              <div class="controls" id="packing_size">
              <select class="span8">
                    <option>Select</option>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Enter Quantity:</label>
              <div class="controls">
                <input type="text" name="qty" value="0" class="span11">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Enter Price:</label>
              <div class="controls">
                <input type="text" name="price" value="0" class="span11">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Enter Party Name:</label>
              <div class="controls" id="party_name">
              <select class="span8">
                    <option>Select</option>
                </select>
              </div>
            </div>
        
            <div class="form-actions">
              <button type="submit" name="submit1" class="btn btn-success">Save</button>
            </div>
            <div class="alert alert-success" id="success" style="display:none;">
                Purchase Inserted Successfully.
            </div>

          </form>
        </div>
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

