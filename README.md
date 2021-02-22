# Description

This will recommend next available username based on the email address. The username will always be unique and will add a number suffix at the end of the base email address. The number is sequencial number and will increment accordingly. If there is a missing number in the sequence it will used that missing number as a suffix of the base email address.

PHP version 7 is recommended in running the script.


# Usage

1. Clone the repo `https://github.com/massquote/recommend-username.git`.
2. Add your txt file in the /res folder. txt file should contain registered name. One line considered 1 record. Then update the path in line 17 of the index.php file.
3. run the script by typing.
   
   `php index.php`

4. Enter the email address then script will recommend the next username
