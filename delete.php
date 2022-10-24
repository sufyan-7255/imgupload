<?php
include("connection.php");
$deletequery = "delete from producttbl where id = '".$_GET["pid"]."'";
$deletequeryconnect = mysqli_query($con, $deletequery);
if($deletequeryconnect)
{
    header("Location:insert.php");
}
else
{
    echo mysqli_error($con);
}
?>