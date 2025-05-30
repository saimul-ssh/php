<?php include_once "app/db.php"; ?>
<?php include_once "app/functions.php"; ?>

<?php 

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

    $sql = "DELETE from students where id='$id' ";
    $data = $mysqli -> query($sql);

    // redirect to homepage
    header("location:index.php");

?>