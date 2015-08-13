<?php
$error = filter_input(INPUT_GET, 'err', $filter = FILTER_SANITIZE_STRING);
 
if (! $error) {
    $error = 'Ups! Ett okänt problem har uppstod.';
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

        <h1>Det uppstod ett problem</h1>
        <p class="error"><?php echo $error; ?></p>  

    </div> <!-- content -->
</div> <!-- container -->


<?php
include "footer.php";
?>
