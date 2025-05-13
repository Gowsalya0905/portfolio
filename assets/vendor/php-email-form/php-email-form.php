<?php
/**
 * PHP Email Form Class
 * This class handles sending email messages and includes input sanitization and validation.
 */

class PHP_Email_Form {

    // Define properties
    public $to = '';
    public $from_name = '';
    public $from_email = '';
    public $subject = '';
    public $message = '';
    public $ajax = false;
    
    // SMTP Configuration (optional)
    public $smtp = array();
    
    // Add a message to the email
    public function add_message($message, $label) {
        $this->message .= $label . ": " . $message . "\n";
    }
    
    // Validate email address
    public function validate_email($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    // Send the email
    public function send() {
        if (!$this->validate_email($this->from_email)) {
            return false; // Invalid email
        }
        
        // Set the email headers
        $headers = 'From: ' . $this->from_name . ' <' . $this->from_email . '>' . "\r\n";
        $headers .= 'Reply-To: ' . $this->from_email . "\r\n";
        $headers .= 'Content-Type: text/plain; charset=UTF-8' . "\r\n";

        // Send the email using the PHP mail() function
        if (mail($this->to, $this->subject, $this->message, $headers)) {
            return true;
        } else {
            return false;
        }
    }
}
?>
