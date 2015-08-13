<?php
$success = filter_input(INPUT_GET, 'success', $filter = FILTER_SANITIZE_STRING);
$back = filter_input(INPUT_GET, 'back', $filter = FILTER_SANITIZE_STRING);
 
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
        <?php if(empty($back)): ?>
        	<button onclick="goBack()">Gå tillbaka till föregående sida</button> 
        

    <?php else: ?>
        	<a href=<?php echo $back; ?> > <button>Gå tillbaka till föregående sida</button> </a>
        
        <?php endif; ?>
        

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
