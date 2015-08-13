<!-- This is the include page that is used by ../public/searchUsers.php to create a list of service messages matching the search -->

<?php
// Include files with information about the connection to the databse
include_once 'db_connect.php';
include_once 'psl-config.php';
    
    //Get the variables entered in ../public/searchUsers.php
    if (isset($_POST['search'])) {
    // Sanitize and validate the data passed in

    $search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);
    if ($search=="Namn eller E-mail"){
        $search='';
    }
    //Entering a % at the start and end of the search, to get all the users who got a title or message containing the search string
    $search= "%". $search. "%";

    $text = '';
    $editform = '';
    $nu=date('Y-m-d\TH:i');
    $sen=date('Y-m-d\TH:i', strtotime('+1 hours'));
    


 

    //Searches the database for messages with matching the entered search.  Store the result in the result variable
    $prep_stmt = "SELECT id, title, message, start_time, stop_time, close FROM s_message WHERE title LIKE ? OR message LIKE ?";
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
        <th class='user-meny'>Titel</th>
        <th class='user-meny'>Meddelande</th>
        <th class='user-meny'>Tid</th>
        <th class='user-meny'>Stäng sidan</th>
        <th class='user-meny'>Redigera</th>
        <th class='user-meny'>Ta bort</th>
        </tr> ";
        while($row = $result->fetch_assoc()) {

           

            $text.="<tr class='user-meny'> <td class='user-meny'>    " . $row['id']. "</td>
            <td class='user-meny'>    " . $row['title'].  "</td>   

             

            <td class='user-meny'><button id='removeButton' class='fancybox fancybox.inline' href='#message".$row['id']."'> Visa </button></td>
            
            <div style='display:none;' id='message".$row['id']."' >
                 <strong> ".$row['title']." </strong><br>
                 <p>".$row['message']." </p>
            </div>";

            $text.="<td class='user-meny'>    " . $row['start_time']. " -<br> ". $row['stop_time']."</td>";
        
            if($row['close']=='1'){ 
                $text.="<td class='user-meny'>Ja</td>"; } 

            else { 
                $text.="<td class='user-meny'>Nej</td>"; }

            //Add the edit button to the string, and makes a remove button. It also creates a function for
            //every row of the remove button that asks for a confirmation if you want to remove the message
            //or not before removing it

            $text.="<td class='user-meny'><button id='removeButton' class='fancybox fancybox.inline' href='#editSMessage".$row['id']."'> Redigera </button></td>
            <td class='user-meny'> 

            <button type='button' id='removeButton' onclick='confirmButton".$row['id']."()''>Ta bort</button> </td>

            <script>
                function confirmButton".$row['id']."() {
                    if (confirm('Vill du verkligen ta bort servicemeddelandet: ".$row['title']."') == true) {
                        window.location.href = '../includes/deleteSMessageFromSearch.inc.php?id=".$row['id']."';
                    } 
                }   

            </script>";

            //Here the editform is created, and stored in $editform. It is a text string with the div containing the edit page

            $editform.="<div style='display:none;' id='editSMessage".$row['id']."' >
                
             
   
    <div class='login-head'>
        <h1>Redigera servicemeddelande</h1>
         <div class='alert-close'> </div>           
    </div>

        <!-- Creates the form for editing users. When the submit button is pressed, it uses ../includes/editUser.inc.php to make
        the changes in the database -->
        <form   class='loginForm' action='../includes/editSMessage.inc.php' 
                method='post' 
                name='edit_form'>
                
                
                <p type='text' name='idtext' class='text' value='".$row['id']."'>Du redigerar servicemeddelandet: ".$row['title']." </p>
                
            
            <!-- create a hidden field in the form for the id of the user. It is hidden because the admin is not allowed to
            change the ID, but the field is needed in order to get the id variable to the ../includes/editUser.inc.php page -->
             <li style='display:none;'>
                <input style='color:#000;' type='text' name='id' class='text' value='".$row['id']."' >
            </li>
            
            <!-- Here the admin can enter the new email, username or admin of users. When the page is loaded the old values 
            are entered in the box -->
            <li>
                <input style='color:#000;' type='text' name='title' class='text' value='".$row['title']."'>
            </li>

            <li>
                <input style='color:#000;' type='text' name='message' class='text' value='".$row['message']."'>
            </li>
            Starttid<li>
                <input type='datetime-local' name='starttime' min='".$nu."' value='".$nu."'>
            </li>
            Stoptid
            <li>
                <input type='datetime-local' name='stoptime' min='".$sen."' value='".$sen."'>
            </li>
                <div class='clear'> </div>
            

            <li class='regAdmin'>
            Close page?
            <div class='radio'>
                <input id='yes' type='radio' name='close' value='1' ";
                if($row['close'] =='1'){$editform.='checked';}
                $editform.=">
                <label for='yes'>Ja</label>
                <input id='no' type='radio' name='close' value='0'";
                if($row['close'] !='1'){$editform.='checked';}
                $editform.=">
                <label for='no'>Nej</label>
            </div>

    
            </li> 
            

            <div class='clear'> </div>
            <div class='submit'>
               
               <!-- The submit button. When pressed, calls the function regformhashEditUser in js/forms.js to check that 
            the fields are entered in a correct way. -->
                <input type='submit' onclick='return regformhashService(this.form,
                                   this.form.title,
                                   this.form.message,
                                   this.form.starttime,
                                   this.form.stoptime,
                                   this.form.close);'   value='Ändra'>
             
                          <div class='clear'>  </div>   
            </div>
                
        </form>


            </div>";

        
       // href='../includes/deleteSMessageFromSearch.inc.php?id=".$row['id']."'>Ta bort</a></td></tr>
        }
        $text.="</table>";
    } else {
        $text.="0 results";
    }


    $stmt->close();

    }
    

?>


