<!-- The standard success page that the user gets sent to after doing some actions on the page -->

<?php
//Get the success and back variable that is sent as a parameter to this page from the includes pages.
//Success contains the message that will be printed on this page
//Back contains the link to the page the user can go back to
$success = filter_input(INPUT_GET, 'success', $filter = FILTER_SANITIZE_STRING);
$back = filter_input(INPUT_GET, 'back', $filter = FILTER_SANITIZE_STRING);

//If there is no specific success variable sent to the page, enter a standard message to the success variable
if (! $success) {
    $success = 'Din åtgärd utfördes!';
}
?>

<?php
include 'header.php';

//If the viewer is not logged in, redirects to the login page. Using the login_check function in ../includes/functions.php
if (login_check($mysqli) == false) {
    header("Location: login.php");
}

?>
<div id="container">
    <div id="content">

        <h1>Åtgärd Utförd!</h1>
        <p><?php echo $success; ?></p>
        <!-- If no back variable was sent to this page, makes the go back button redirect to the last page the user was on. Using the goBack() function in this file --> 
        <?php if(empty($back)): ?>
        	<button onclick="goBack()">Gå tillbaka till föregående sida</button> 
        
            <!-- If there was a back variable sent to the page, make the user go back to the link in the back variable -->
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
