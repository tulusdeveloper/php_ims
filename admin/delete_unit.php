<?php
include "../user/connection.php";
$id=$_GET["id"];
mysqli_query($link,"delete from units where id=$id");
?>
<script type="text/javascript">
    window.location="add_new_unit.php";
</script>