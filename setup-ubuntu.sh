#!/bin/bash
# Sets up the Student Management project on Ubuntu
# Run from the project folder:  sudo bash setup-ubuntu.sh

echo "Installing Apache, MySQL and PHP..."
apt update
apt install -y apache2 mysql-server php libapache2-mod-php php-mysql

echo "Creating the database..."
mysql < database.sql

echo "Copying the project to /var/www/html..."
cp -r student_management /var/www/html/
systemctl restart apache2

echo "Done! Open http://localhost/student_management/"
