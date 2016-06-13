<!DOCTYPE html>
<html>
<head>
    <title>String Tester</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
    <main>
        <h1>String Tester</h1>
        <form action="." method="post">
        <input type="hidden" name="action" value="process_data">

        <label>Name:</label>
        <input type="text" name="name" 
               value="<?php echo htmlspecialchars($name); ?>">
			   <span style="color:red"><?php echo $name_error; ?></span>
        <br>

        <label>E-Mail:</label>
        <input type="text" name="email" 
               value="<?php echo htmlspecialchars($email); ?>">
			   <span style="color:red"><?php echo $email_error; ?></span>
        <br>

        <label>Phone Number:</label>
        <input type="text" name="phone" 
               value="<?php echo htmlspecialchars($phone); ?>">
			   <span style="color:red"><?php echo $phone_error; ?></span>
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Submit">
        <br>

        </form>

        <h2>Message:</h2>
        <p><?php echo nl2br(htmlspecialchars($message)); ?></p>		

    </main>
</body>
</html>