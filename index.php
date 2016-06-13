<?php
//set default values
$name = '';
$name_error = '';
$email_error = '';
$email = '';
$phone = '';
$phone_error = '';
$phonedisplay = '';
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
				$name_error = 'Error';
				break;
			case !preg_match("/^([a-z]+)(\s)?([a-z]*)/i", $name) :
				$message = 'Please enter a valid first, last, or first and last name.';
				$name_error = ' Error';
				break;
			
		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		{			
				$email_error = 'Error';
				$message = 'Please enter a valid email';				
		}
		
		switch ($phone)
		{
			case '':
				$phone_error = 'Error';
				$message = 'Please enter a phone number.';
				break;
			case !preg_match("/^((((\+[\d\-.]{1,5})?[ \-.]?\d{3})|(\+[\d\-.]{1,5})?[ \-.]?\((\d{3}\)))?[ \-.]?\d{3}[ \-.]?\d{4})?$/i", $phone) :
				$phone_error = 'Error';
				$message = 'Please enter a valid phone number';
				break;
			
		}
		if (strlen($phone) === 7 && strlen($phone) !== 10)
		{
			$part1 = substr_replace($phone, '-', 3);
			$part2 = substr($phone, 3);
			$phonedisplay = $part1 . $part2;	
		}	
			
		else if (strlen($phone) === 10)
		{
			$part1 = substr_replace($phone, '-', 3);
			$part2 = substr($phone, 3);
			$part3 = substr_replace($part2, '-', 3);
			$part4 = substr($phone, 6);
			$phonedisplay = $part1 . $part3 . $part4;			
		}									
}
if ($action == 'process_data') //This only loads once the data has been processed
{
		if(strpos($name, ' ') > 0)
	{
		
		$splitname = explode(' ', $name);
		$firstname = ucfirst($splitname[0]);
		$lastname = ucfirst($splitname[1]);
	}
	else
	{
		$firstname = ucfirst($name);
		$lastname = '';
	}
	if ($name_error == '' && $email_error == '' && $phone_error == '')
	{
		$message = 'Hello '.$firstname.", \n\n".
		"Thank you for entering this data: \n\n".
		'Name: '.$firstname.' '.$lastname."\nEmail: ".$email."\nPhone: ".$phonedisplay;
	}
}



include 'string_tester.php';
?>