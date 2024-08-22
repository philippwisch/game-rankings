#!/bin/bash

# Variables
DB_NAME="game_rankings"
DB_USER="postgres"

# sudo apt update

# Install php8.0, apache2 and postgresql
sudo apt install -y apache2 php8.3 postgresql

# Start services
sudo systemctl start apache2
sudo systemctl start postgresql

# Create Database
sudo -u postgres psql -f setup.sql

# Give the apache server the webpage
sudo cp index.php /var/www/html
sudo chown www-data:www-data /var/www/html/index.php
sudo chmod 644 /var/www/html/index.php

echo "Setup completed!"