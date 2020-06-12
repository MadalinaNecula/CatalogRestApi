# CatalogRestApi
This is a RESTful API application that exposes an endpoint to manage a catalog product. 
Technologies used: PHP and MySQL.
Apps used: Postman

The database contains 3 tables: category, products and users. 
In order to see how the application work you have to download the source code and copy in htdocs folder. 

To see products from database you have to type http://localhost/Product/read.php.


In the similar way you have to type http://localhost/Product/update.php or /delete.php , etc for others operations.


You can also create a user if you type http://localhost/create_user.php and write the json body like in this example: 

{
 "firstname" : "exampleOfFirstName",
 
 "lastname" : "exampleOfLastName",
 
 "email" : "exampleOfEmail@gmail.com",
 
 "password" : "exampleOfPassword"
}


After you created an user you can use /login.php to log in. You also have to validate the token received by using /validate_token.php
