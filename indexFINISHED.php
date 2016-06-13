<?php
//set default values
$name = '';
$email = '';
$phone = '';
$phone_error = '';
$message = 'Enter some data and click on the Submit button.';

//process
$action = filter_input(INPUT_POST, 'action');

switch ($action) 
{
    case 'process_data':
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');
		
		switch ($name)
		{
			case '' :
				$message = 'Please enter a name.';
				break;
			case !ctype_alpha($name) :
				$message = 'Name must be comprised of letters.';
				break;
			default:
				$name = strtoupper(substr($name, 0, 1)) . strtolower(substr($name, 1));				
				break;
		}
		switch ($email)
		{
			case '' :
				$message = 'Please enter an email address.';
				break;
			case strpos($email, '@', 0) === 0:
				$message = 'Valid emails do not start with a "@". Please enter a valid email.';
				break;
			case strpos($email, '@', 0) > 1:
				$message = 'Valid emails do not have more than 1 "@". Please enter a valid email.';
				break;
			case strpos($email, '@', 0) === FALSE:
				$message = 'Did you forget the "@"?';
				break;
			case strpos($email, '.', 0) === FALSE:
				$message = 'Did you forget the "."?';
				break;
			case strpos($email, '.', 0) === 0:
				$message = 'Valid emails do not start with a ".". Please enter a valid email.';
				break;
		}
		switch ($phone)
		{
			case '':
				$phone_error = 'Please enter a phone number';
				break;
			case !ctype_digit($phone) :
				$phone_error = 'Phone number must be numbers only.';
				break;			
			case strlen($phone) === 7:
				$part1 = substr_replace($phone, '-', 3);
				$part2 = substr($phone, 3);
				$phone = $part1 . $part2;
				echo $phone;
				break;
			case strlen($phone) === 10:
				$part1 = substr_replace($phone, '-', 3);
				$part2 = substr($phone, 3);
				$part3 = substr_replace($part2, '-', 3);
				$part4 = substr($phone, 6);
				$phone = $part1 . $part3 . $part4;				
				break;
			default:
				$phone_error = 'Phone number must be either 7 or 10 digits long';
				break;
		}
			
		
		/*************************************************
         * validate and process the name
         ************************************************/
        // 1. make sure the user enters a name
        // 2. make the first letter of the name capitalized
		
        /*************************************************
         * validate and process the email address
         ************************************************/
        // 1. make sure the user enters an email
        // 2. make sure the email address has at least one @ sign and one dot character

        /*************************************************
         * validate and process the phone number
         ************************************************/
        // 1. make sure the user enters at least seven digits, not including formatting characters
        // 2. format the phone number like this 123-4567 or this 123-456-7890

        /*************************************************
         * Display the validation message
         ************************************************/
		
		$splitname = explode(' ', $name);
		$firstname = ucfirst($splitname[0]);
		$lastname = ucfirst($splitname[1]);
        $message = 'Hello ' . $firstname . ", \n\n" .
		"Thank you for entering this data: \n\n" .
		'Name: ' . $firstname . ' ' . $lastname . "\nEmail: " . $email . "\nPhone: ".$phone;

        break;
}
include 'string_tester.php';
?>