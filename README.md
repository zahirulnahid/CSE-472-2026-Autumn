# Student Management System

A simple PHP + MySQL project (W3Schools style) that runs on Ubuntu with Apache.

You can add, edit, delete and view students, and register user accounts.

## Files

```
student_management/
  config.php     database connection
  index.php      list of all students
  add.php        add a student
  edit.php       edit a student
  delete.php     delete a student
  register.php   register a user
  style.css
database.sql     creates the database and tables
setup-ubuntu.sh  installs and sets up everything
```

## Run on Ubuntu

Open a terminal in the project folder and run:

```bash
sudo bash setup-ubuntu.sh
```

Then open **http://localhost/student_management/** in your browser.

<details>
<summary>Or do it by hand</summary>

```bash
# 1. Install Apache, MySQL and PHP
sudo apt update
sudo apt install -y apache2 mysql-server php libapache2-mod-php php-mysql

# 2. Create the database
sudo mysql < database.sql

# 3. Copy the project to the web folder
sudo cp -r student_management /var/www/html/
sudo systemctl restart apache2
```
</details>

## Run on Windows (XAMPP)

1. Start **Apache** and **MySQL** in XAMPP.
2. Copy the `student_management` folder to `C:\xampp\htdocs\`.
3. Open http://localhost/phpmyadmin, go to the **SQL** tab, and run the contents of `database.sql`.
4. Open http://localhost/student_management/.

## Check that everything works

```bash
systemctl is-active apache2
systemctl is-active mysql
php -v
curl -I http://localhost/student_management/register.php
sudo mysql -e "USE student_db; SHOW TABLES;"
sudo mysql -e "USE student_db; SELECT * FROM students;"
sudo mysql -e "USE student_db; SELECT id, full_name, email FROM users;"
```

## Common problems

| Problem | Fix |
|---|---|
| Browser shows PHP code | `sudo apt install libapache2-mod-php` then `sudo systemctl restart apache2` |
| `Connection failed` | The password in `config.php` must match the one in `database.sql` |
| Blank page | `sudo tail /var/log/apache2/error.log` |
| Can't open the page from another PC | Allow port 80: `sudo ufw allow 'Apache'` |
