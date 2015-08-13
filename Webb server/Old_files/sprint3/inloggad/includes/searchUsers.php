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
    $editform ='';
    


 

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
            <td class='user-meny'>    " . $row['email']. "</td>

            ";

        
            if($row['admin']=='1'){ 
                $text.="<td class='user-meny'>Ja</td>"; } 

            else { 
                $text.="<td class='user-meny'>Nej</td>"; }

            $text.="<td class='user-meny'><button id='removeButton' class='fancybox fancybox.inline' href='#message".$row['id']."'> Redigera </button></td>
            
            
    
            <td class='user-meny'>  

            <button type='button' id='removeButton' onclick='confirmButton".$row['id']."()'>Ta bort</button> </td></tr>

            <script>
                function confirmButton".$row['id']."() {
                    var x;
                    if (confirm('Press a button!') == true) {
                        window.location.href = '../includes/deleteUser.php?id=".$row['id']."';
                    } 
                }   

            </script>";

    $editform.="<div style='display:none;' id='message".$row['id']."' >
                
                
   
    <div class='login-head'>
        <h1>Redigera användare</h1>
         <div class='alert-close'> </div>           
    </div>

        <!-- Creates the form for editing users. When the submit button is pressed, it uses ../includes/editUser.inc.php to make
        the changes in the database -->
        <form   class='loginForm' action='../includes/editUser.inc.php' 
                method='post' 
                name='edit_form'>
                
                
                <p type='text' name='idtext' class='text' value='".$row['id']."'>Du redigerar användaren: ".$row['username']." </p>
                
            
            <!-- create a hidden field in the form for the id of the user. It is hidden because the admin is not allowed to
            change the ID, but the field is needed in order to get the id variable to the ../includes/editUser.inc.php page -->
             <li style='display:none;'>
                <input style='color:#000;' type='text' name='id' class='text' value='".$row['id']."' >
            </li>
            
            <!-- Here the admin can enter the new email, username or admin of users. When the page is loaded the old values 
            are entered in the box -->
            <li>
                <input style='color:#000;' type='text' name='username' class='text' value='".$row['username']."'>
            </li>

            <li>
                <input style='color:#000;' type='text' name='email' class='text' value='".$row['email']."'>
            </li>
                <div class='clear'> </div>
            

            <li class='regAdmin'>
            Administratör?
            <div class='radio'>
                <input id='yes' type='radio' name='admin' value='1' ";
                if($row['admin'] =='1'){$editform.='checked';}
                $editform.=">
                <label for='yes'>Ja</label>
                <input id='no' type='radio' name='admin' value='0'";
                if($row['admin'] !='1'){$editform.='checked';}
                $editform.=">
                <label for='no'>Nej</label>
            </div>

    
            </li> 
            

            <div class='clear'> </div>
            <div class='submit'>
               
               <!-- The submit button. When pressed, calls the function regformhashEditUser in js/forms.js to check that 
            the fields are entered in a correct way. -->
                <input type='submit' onclick='return regformhashEditUser(this.form,
                                   this.form.username,
                                   this.form.email,
                                   this.form.admin);'   value='Ändra'>
             
                          <div class='clear'>  </div>   
            </div>
                
        </form>


    
            </div>";
            //$text.="<td class='user-meny'><a href='../includes/deleteUser.php?id=".$row['id']."'>Ta bort</a></tr>";
        
        
        }
        $text.="</table>";
    } else {
        $text.="0 results";
    }


    $stmt->close();

    }

?>
