<!-- This is the include page that is used by ../public/listUsers.php to create a list of users matching the search -->

<?php
// Include files with information about the connection to the databse
include_once 'db_connect.php';
include_once 'psl-config.php';
    
    //Get the variables entered in ../public/listUsers.php
    if (isset($_POST['search'])) {
    // Sanitize and validate the data passed in

    $search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);
    if ($search=="Namn eller E-mail"){
        $search='';
    }
     //Entering a % at the start and end of the search, to get all the users who got a name or email containing with the search string
    $search= "%". $search. "%";

    $text = '';
    


 

    //Searches the database for users with matching the entered search.  Store the result in the result variable
    $prep_stmt = "SELECT id, username, email, admin FROM members WHERE email LIKE ? OR username LIKE ?";
    $stmt = $mysqli->stmt_init();
    $stmt = $mysqli->prepare($prep_stmt);
    
     
    if ($stmt) {
        $stmt->bind_param('ss', $search, $search);
        $stmt->execute();
       //$stmt->store_result();
        $result = $stmt->get_result();
        
        $stmt->close();

    } else {
        $error_msg .= '<p class="error">Database error Line 39</p>';
                $stmt->close();
    }
    

    

    



    
    // Create a string containing html code that creates a table with the result from the search

    if ($result->num_rows > 0) {
        // output data of each row
        $text.="<table class='user-meny'> <tr class='user-meny'> 
        <th class='user-meny'>Id</th> 
        <th class='user-meny'>Namn</th>
        <th class='user-meny'>E-post</th>
        <th class='user-meny'>Admin</th>
        <th class='user-meny'>Redigera användare</th>
        <th class='user-meny'>Ta bort användare</th>
        </tr> ";
        while($row = $result->fetch_assoc()) {

           

            $text.="<tr class='user-meny'> <td class='user-meny'>    " . $row['id']. "</td>
            <td class='user-meny'>    " . $row['username'].  "</td>
            <td class='user-meny'>    " . $row['email']. "</td>";
        
            if($row['admin']=='1'){ 
                $text.="<td class='user-meny'>Ja</td>"; } 

            else { 
                $text.="<td class='user-meny'>Nej</td>"; }

            $text.="<td class='user-meny'><a href='editUser.php?id=".$row['id']."'>Redigera</a>
            <td class='user-meny'> 

            <button type='button' id='removeButton' onclick='confirmButton".$row['id']."()''>Ta bort</button> </td>

            <script>
                function confirmButton".$row['id']."() {
                    var x;
                    if (confirm('Press a button!') == true) {
                        window.location.href = '../includes/deleteUser.php?id=".$row['id']."';
                    } 
                }   

            </script>";
            //$text.="<td class='user-meny'><a href='../includes/deleteUser.php?id=".$row['id']."'>Ta bort</a></tr>";
        
        
        }
        $text.="</table>";
    } else {
        $text.="0 results";
    }


    $stmt->close();

    }

?>
