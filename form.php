<?php

// function to check if message is correct (must have at least 10 caracters (after trimming))
function validate_message($message){
    $trimmed_message=trim($message); 
    if(strlen($trimmed_message) >= 10){
        return true;
    }
    else{
        return false;
    }
}

// function to check if username is correct (must be alphanumeric => Use the function 'ctype_alnum()')
function validate_username($username)
{
        if(ctype_alnum($username)){
            return true;
        }
        else{
            return false;
        }
}

// function to check if email is correct (must contain '@')
function validate_email($email)
{
    if(strpos($email,"@")){
        return true;
    }
    else{
        return false;
    }
}


$user_error = "";
$email_error = "";
$terms_error = "";
$message_error = "";
$username = "";
$email = "";
$message = "";

$form_valid = false;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Here is the list of error messages that can be displayed:
    //
    // "Message must be at least 10 caracters long"
    // "You must accept the Terms of Service"
    // "Please enter a username"
    // "Username should contains only letters and numbers"
    // "Please enter an email"
    // "email must contain '@'"
if(validate_message($_POST['message'])==false){
    $message_error='Message must be at least 10 caracters long';
}else{
    $message=($_POST['message']);
}


if ($_POST['username'] == "") {
    $user_error = "Please enter a username";
} elseif (validate_username($_POST['username']) == false) {
    $user_error = 'Username should contain only letters and numbers';
} else {
    $username = $_POST['username'];
}


if ($_POST['email'] == "") {
    $email_error = "Please enter an email";
} elseif (validate_email($_POST['email']) == false) {
    $email_error = "Email must contain '@'";
} else {
    $email = $_POST['email'];
}


$terms_error= empty($_POST['terms'])? "You must accept the Terms of Service": "";


if (empty($user_error) && empty($email_error) && empty($message_error) && empty($terms_error)) {
    $form_valid = true;
}

}
?>

<form action="#" method="post">
    <div class="row mb-3 mt-3">
        <div class="col">
            <input type="text" class="form-control" placeholder="Enter Name" name="username">
            <small class="form-text text-danger"> <?php echo htmlspecialchars($user_error); ?></small>
        </div>
        <div class="col">
            <input type="text" class="form-control" placeholder="Enter email" name="email">
            <small class="form-text text-danger"> <?php echo htmlspecialchars($email_error); ?></small>
        </div>
    </div>
    <div class="mb-3">
        <textarea name="message" placeholder="Enter message" class="form-control"></textarea>
        <small class="form-text text-danger"> <?php echo htmlspecialchars($message_error); ?></small>
    </div>
    <div class="mb-3">
        <input type="checkbox" class="form-control-check" name="terms" id="terms" value="terms"> <label for="terms">I accept the Terms of Service</label>
        <small class="form-text text-danger"> <?php echo htmlspecialchars($terms_error); ?></small>
    </div>
    <div class="d-grid">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

<hr>

<?php
if ($form_valid) :
?>
    <div class="card">
        <div class="card-header">
            <p><?php echo htmlspecialchars($username); ?></p>
            <p><?php echo htmlspecialchars($email); ?></p>
        </div>
        <div class="card-body">
            <p class="card-text"><?php echo htmlspecialchars($message); ?></p>
        </div>
    </div>
<?php
endif;
?>