<?php
/**
 * Contact Form PHP Script
 */

// Define the email recipient
$receiving_email_address = '7239200106012gowsalya@gmail.com'; // Replace with your email address

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form inputs
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Include the PHP_Email_Form library if available
    if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
        include($php_email_form);
    } else {
        die('Unable to load the "PHP Email Form" Library!');
    }

    // Create the contact form object
    $contact = new PHP_Email_Form;
    $contact->ajax = true;

    // Set email details
    $contact->to = $receiving_email_address;
    $contact->from_name = $name;
    $contact->from_email = $email;
    $contact->subject = $subject;

    // Add message content
    $contact->add_message($name, 'From');
    $contact->add_message($email, 'Email');
    $contact->add_message($message, 'Message', 10);

    // Send the email
    $response = $contact->send();

    // Check if the email was sent successfully
    if ($response) {
        echo "Message sent successfully.";
    } else {
        echo "Unable to send message. Please try again later.";
    }
} else {
    die("Invalid request");
}
?>
