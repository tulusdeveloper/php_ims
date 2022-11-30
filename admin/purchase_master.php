
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
                <select class="span11" name="company_name" id="company_name" onchange="select_company(this.value)">
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
                <select class="span11">
                    <option>Select</option>
                </select>
                </div>
            </div>

            <div class="control-group">
              <label class="control-label">Select Packing Size:</label>
              <div class="controls" id="packing_size">
              <select class="span11">
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
              <label class="control-label">Select Party Name:</label>
              <div class="controls" id="party_name">
              <select class="span11">
                    <option>Select</option>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Select Purchase Type:</label>
              <div class="controls" id="purchase_type">
              <select class="span11">
                    <option>Cash</option>
                    <option>Debit</option>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Enter Expiry Date:</label>
              <div class="controls">
                <input type="text" name="expiry_date" class="span11" placeholder="YYYY-MM-DD" required pattern="\d(4)-\d(2)-\(2)">
              </div>
            </div>
        
            <div class="form-actions">
              <button type="submit" name="submit1" class="btn btn-success">Purchase Now</button>
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

<script type="text/javascript">
  function select_company(company_name)
  {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
        document.getElementById("product_name").innerHTML=xmlhttp.responseText;
      }
    };
    xmlhttp.open("GET", "forajax/load_product_using_company.php?company_name="+company_name, true);
    xmlhttp.send();
  }
</script>

<?php
if(isset($_POST["submit1"]))
{
    $count=0;
    $res=mysqli_query($link,"select * from products where company_name='$_POST[company_name]' && product_name='$_POST[product_name]' && unit='$_POST[unit]' && packing_size='$_POST[packing_size]'") or die(mysqli_error($link));
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
        mysqli_query($link,"insert into products value(NULL,'$_POST[company_name]','$_POST[product_name]','$_POST[unit]','$_POST[packing_size]')") or die(mysqli_error($link));

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

