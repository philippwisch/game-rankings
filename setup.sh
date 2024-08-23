#!/bin/bash

# Variables
DB_NAME="game_rankings"
DB_USER="postgres"

# sudo apt update

# Install php8.0, apache2 and postgresql
sudo apt install -y apache2 php8.3 postgresql

# Start database
sudo systemctl start postgresql

# Create Database
sudo -u postgres psql -f setup.sql

# Give the webpage to the apache server
sudo cp index.php /var/www/html
sudo chown www-data:www-data /var/www/html/index.php
sudo chmod 644 /var/www/html/index.php

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