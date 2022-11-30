<?php
include "../../user/connection.php";
$company_name=$_GET["company_name"];
$res=mysqli_query($link,"select * from products where company_name='$company_name'");

?>
<div class="control-group">
<select class="" name="product_name" id="product_name" onchange="select_product(this.value,'<?php echo $company_name ?>')">
<option class="span11">Select</option>
</div>
<?php
while($row=mysqli_fetch_array($res))
{
    echo "<option>";
    echo $row["product_name"];
    echo "</option>";
}
echo "</select>";
?>