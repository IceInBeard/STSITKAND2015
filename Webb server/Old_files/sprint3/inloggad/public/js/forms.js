function formhash(form, password) {
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");
 
    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
 
    // Finally submit the form. 
    form.submit();
}
 
function regformhash(form, uid, email, password, conf, admin) {
     // Check each field has a value

    if (uid.value == ''         || 
          email.value == ''     || 
          password.value == ''  || 
          conf.value == ''      ||
          admin.value == ''
          ) {
 
        alert('Du måste fylla i alla fält. Var vänlig försök igen');
        return false;
    }
    
 
    // Check the username
 
    re = /^\w+$/; 
    if(!re.test(form.username.value)) { 
        alert("Användarnamnet får endast innehålla bokstäver, siffror och understreck. Var vänlig försök igen"); 
        form.username.focus();
        return false; 
    }
 
    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (password.value.length < 6) {
        alert('Lösenordet måste vara minst 6 tecken långt. Var vänlig försök igen');
        form.password.focus();
        return false;
    }
 
    // At least one number, one lowercase and one uppercase letter 
    // At least six characters 
 
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(password.value)) {
        alert('Lösenordet måste innehålla minst en siffra, en liten och stor bokstav. Var vänlig försök igen');
        return false;
    }
 
    // Check password and confirmation are the same
    if (password.value != conf.value) {
        alert('Dina lösenord matchar inte. Var god försök igen. ');
        form.password.focus();
        return false;
    }

 
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");
 
    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
    conf.value = "";
 
    // Finally submit the form. 
    form.submit();
    return true;
}

function regformhashChangePass(form, currentPass, password, conf) {
     // Check each field has a value

    

    if (  password.value == ''  || 
          conf.value == ''  ||
          currentPass.value ==''
          ) {
    
        alert('Du måste ge alla efterfrågade detaljer. Var god försök igen.');
        return false;
    }
    
    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (password.value.length < 6) {
        alert('Lösenordet måste vara minst 6 tecken långt. Var god försök igen.');
        form.password.focus();
        return false;
    }
 
    // At least one number, one lowercase and one uppercase letter 
    // At least six characters 
 
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(password.value)) {
        alert('Lösenordet måste innerhålla minst ett nummer, en liten och en stor bokstav. Var god försök igen.');
        return false;
    }
 
    // Check password and confirmation are the same
    if (password.value != conf.value) {
        alert('Dina lösenord matchar inte. Var god försök igen.');
        form.password.focus();
        return false;
    }

 
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");
 
    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
    conf.value = "";
    // Finally submit the form. 

    form.submit();
    return true;
}



function regformhashEditUser(form, uid, email, admin) {
     // Check each field has a value

    if (  uid.value == ''       ||
          email.value == ''     || 
          admin.value == ''
          ) {
 
        alert('Du måste fylla i alla fält. Var vänlig försök igen');
        return false;
    }
    
 
    // Check the username
 
    re = /^\w+$/; 
    if(!re.test(form.username.value)) { 
        alert("Användarnamnet får endast innehålla bokstäver, siffror och understreck. Var vänlig försök igen"); 
        form.username.focus();
        return false; 
    }
 
 
    // Finally submit the form. 
    form.submit();
    return true;
}