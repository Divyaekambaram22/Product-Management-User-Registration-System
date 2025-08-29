# Product-Management-User-Registration-System
A simple web-based application built using **PHP, MySQL, HTML, CSS and JavaScript** for managing products and handling user registrations with email verification.  


## Features  
- User Registration with Email Verification  
- Product CRUD (Create, Read, Update, Delete)  
- Product Listing in Card Format  
- Secure Login & Session Handling  
- Admin Panel for Product Management  
- Form Validation  
- Email Notifications via **PHPMailer**  


##  Technologies & Tools Used  
- **Frontend:** HTML, CSS and JavaScript   
- **Backend:** PHP (Core PHP)  
- **Database:** MySQL  
- **Server:** XAMPP (Apache + MySQL)  
- **Libraries:**  
  - Composer (Dependency Manager)  
  - PHPMailer (Email Service)  
- **Email Setup:** Gmail SMTP with 2-Step Verification + App Password  



## Installation Guide  
1. Install **XAMPP** and start Apache & MySQL.  
2. Place project folder inside `htdocs`.  
3. Create a database `registration_system db` in phpMyAdmin and import the `.sql` file.  
4. Install Composer → `composer install`  
5. Install PHPMailer → `composer require phpmailer/phpmailer`  
6. Configure Gmail SMTP in `register.php` using App Password.  
7. Run project in browser → Localhost 

