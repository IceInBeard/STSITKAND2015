<?php
$success = filter_input(INPUT_GET, 'success', $filter = FILTER_SANITIZE_STRING);
 
if (! $success) {
    $success = 'Din åtgärd utfördes!';
}
?>

<?php
include 'header.php';

if (login_check($mysqli) == false) {
    header("Location: login.php");
}

?>
<div id="container">
    <div id="content">

        <h1>Åtgärd Utförd!</h1>
        <p><?php echo $success; ?></p> 
        <button onclick="goBack()">Gå tillbaka till föregående sida</button> 

    </div> <!-- content -->
</div> <!-- container -->



<script>
function goBack() {
    window.history.back();
}
</script>


<?php
include "footer.php";
?>
