#!/bin/bash

# Variables
DB_NAME="game_rankings"
DB_USER="game_rankings"

# sudo apt update

# Install php8.0, apache2 and postgresql
sudo apt install -y apache2 php8.3 postgresql php8.3-pgsql

## database setup

# Start database
sudo systemctl start postgresql

# create a new user for this webapp
sudo -u postgres psql -c "CREATE USER $DB_USER WITH PASSWORD 'changethispostgresspassword';"

# Create Database and Tables
sudo -u postgres psql -c "CREATE DATABASE $DB_NAME WITH OWNER $DB_USER;"
sudo -u postgres psql -d $DB_NAME -f setup.sql

## webserver setup

# Give the webpage to the apache server
sudo cp index.php /var/www/html
sudo cp styles.css /var/www/html
sudo cp script.js /var/www/html
sudo cp game-rankings.php /var/www/html
# sudo chown www-data:www-data /var/www/html/index.php
# sudo chmod 644 /var/www/html/index.php

# Let the server serve the given page by default instead of index.html
echo "DirectoryIndex index.php index.html" | sudo tee -a /var/www/html/.htaccess
sudo chown www-data:www-data /var/www/html/.htaccess
sudo chmod 644 /var/www/html/.htaccess

# Apache needs to be configured to allow changing the document root (above command)
CONFIG_FILE="/etc/apache2/apache2.conf"
sudo sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' "$CONFIG_FILE"

# Restart apache
sudo systemctl restart apache2

echo "Setup completed!"