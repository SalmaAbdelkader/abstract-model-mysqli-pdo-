# Abstract Model with PHP OOP, PDO & MySQL (Factory Design Pattern)

## 📌 Introduction
This project implements an Abstract Model using PHP OOP, PDO, and MySQL, following the Factory Design Pattern. The purpose of this approach is to standardize database interactions, improve maintainability, and promote reusable code structures.

## 🚀 Features
- Abstract Model to streamline CRUD operations
- Factory Pattern for managing object creation
- Secure database interactions using PDO
- Supports multiple database connections
- Prevents SQL injection with prepared statements
- Transaction management

## 🛠️ Technologies Used
- PHP (OOP-based architecture)
- MySQL (with PDO for database interaction)
- Factory Design Pattern

## 🔧 Installation
### Prerequisites:
- Apache server (XAMPP, WAMP, or LAMP)
- PHP 7.4 or higher
- MySQL database

### Steps to Install:
1. Clone this repository:
   ```sh
   git clone https://github.com/SalmaAbdelkader/abstract-model-mysqli-pdo-.git
   ```
2. Move the project folder to your web server root directory (e.g., `htdocs` in XAMPP).
3. Configure database connection in `config/Database.php`:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'testing');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   ```
4. Start Apache and MySQL from your local server.
5. Use the Abstract Model by including it in your project.

## 📂 Project Structure
```
/abstract-model-php-factory
│── /config          # Database configuration
│── /src             # Core model classes
│   ├── AbstractModel.php   # Base model with CRUD operations
│   ├── Factory.php         # Factory class for object creation
│── /models          # Specific models (e.g., UserModel, ProductModel)
│── /examples        # Usage examples
│── /tests           # Unit tests
│── index.php        # Sample usage
│── composer.json    # Dependencies
```

## 🔍 Key Functionalities
- `AbstractModel.php`: Defines a base class with generic CRUD methods.
- `Factory.php`: Implements Factory Pattern to create instances of models dynamically.
- `UserModel.php`: Extends `AbstractModel` to manage user-related operations.

## 🏗️ How to Use
Example usage:
```php
<?php


require_once "config/connect.php";
require 'abstractmodel.php';
require "users.class.php";

/*
    ================== Method save() ============== 
    $user = users::getDataByPrimaryKey(19);
    $user->setName('Ahmed Ali') ;
    var_dump($user->save());

*/


/*
    ================== Method update() ============== 
    $user = users::getDataByPrimaryKey(19);
    $user->setName('Ali Ahmed') ;
    var_dump($user->update());

*/

/*
    ================== Method create() ============== 
    $user = new users('ali ahmed', 'ali@d.com', 123, 22, 'cairo', 5000, 1.2);
    echo $user = $user->create();

*/
/*
    ================== Method getDataByPrimaryKey($pk) ============== 
    echo "<pre>";
    $user = users::getDataByPrimaryKey(17);
    var_dump($user);

*/
/*
    ================== Method getAllData() ============== 
    echo "<pre>";
    var_dump(users::getAllData());
*/



/*
    ================== Method get() ============== 
    $user = users::get(
            "SELECT * FROM users WHERE name = :name",
                array(
                    'name' => array(users::DATA_TYPE_STRING, 'mahmoud Ahmed')
                )
            );
    echo "<pre>";
    var_dump($user);

*/

/*
    ================== Method delete() ============== 
    $user = users::getDataByPrimaryKey(19);
    echo $user->delete();
*/


```

## 🏗️ How to Contribute
1. Fork the repository.
2. Create a new branch: `git checkout -b feature-branch`
3. Commit your changes: `git commit -m 'Add new feature'`
4. Push to the branch: `git push origin feature-branch`
5. Open a pull request.

## 🛡️ Security & Best Practices
- Use prepared statements with PDO to prevent SQL injection.
- Sanitize user input to avoid XSS attacks.
- Use transactions for critical database operations.
- Restrict access to configuration files.

## 📄 License
This project is open-source and available under the [MIT License](LICENSE).

## 📞 Contact
For any queries or contributions, feel free to reach out:
- GitHub: [https://github.com/SalmaAbdelkader]
- Email: salmaabdelkader2019@gmail.com

