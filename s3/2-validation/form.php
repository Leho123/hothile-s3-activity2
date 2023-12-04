<?php

function validate_message($message)
{
    $trimmedMessage = trim($message);
    if (strlen($trimmedMessage) >= 10) {
        return true; 
    } else {
        return false; 
    }
}
    // function to check if message is correct (must have at least 10 caracters (after trimming))



function validate_username($username)
{
    if (ctype_alnum($username)) {
        return true; 
    } else {
        return false; 
    }
}
    // function to check if username is correct (must be alphanumeric => Use the function 'ctype_alnum()')



function validate_email($email)
{
    if (strpos($email, '@') !== false) {
        return true; 
    } else {
        return false; 
    }
}
    // function to check if email is correct (must contain '@')




$user_error = "";
$email_error = "";
$terms_error = "";
$message_error = "";
$username = "";
$email = "";
$message = "";

$form_valid = false;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate the username
    $username = $_POST['username'];
    
   
    if (empty($username)) {
        $user_error = "Please enter a username";
        $form_valid = false;
        
    } elseif (!ctype_alnum($username)) {
        $user_error = "Username should contain only letters and numbers";
        $form_valid = false;
    }
    

    // Validate the email
    $email = $_POST['email'];
    if (empty($email)) {
        $email_error = "Please enter an email";
        $form_valid = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Invalid email format";
        $form_valid = false;
    }

    // Validate the message
    $message = $_POST['message'];
    if (strlen(trim($message)) < 10) {
        $message_error = "Message must be at least 10 characters long";
        $form_valid = false;
    }

    // Validate the terms checkbox
    if (!isset($_POST['terms'])) {
        $terms_error = "You must accept the Terms of Service";
        $form_valid = false;
    }

    // Check if there are no validation errors
    if (empty($user_error) && empty($email_error) && empty($message_error) && empty($terms_error)) {
        $form_valid = true;
    }
}
    
    // Here is the list of error messages that can be displayed:
    //
    // "Message must be at least 10 caracters long"
    // "You must accept the Terms of Service"
    // "Please enter a username"
    // "Username should contains only letters and numbers"
    // "Please enter an email"
    // "email must contain '@'"


?>

<form action="#" method="post">
    <div class="row mb-3 mt-3">
        <div class="col">
            <input type="text" class="form-control" placeholder="Enter Name" name="username">
            <small class="form-text text-danger"> <?php echo $user_error; ?></small>
        </div>
        <div class="col">
            <input type="text" class="form-control" placeholder="Enter email" name="email">
            <small class="form-text text-danger"> <?php echo $email_error; ?></small>
        </div>
    </div>
    <div class="mb-3">
        <textarea name="message" placeholder="Enter message" class="form-control"></textarea>
        <small class="form-text text-danger"> <?php echo $message_error; ?></small>
    </div>
    <div class="mb-3">
        <input type="checkbox" class="form-control-check" name="terms" id="terms" value="terms"> <label for="terms">I accept the Terms of Service</label>
        <small class="form-text text-danger"> <?php echo $terms_error; ?></small>
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
            <p><?php echo $username; ?></p>
            <p><?php echo $email; ?></p>
        </div>
        <div class="card-body">
            <p class="card-text"><?php echo $message; ?></p>
        </div>
    </div>
<?php
endif;
?>