# php-sample-application-master
PHP 7.2 Sample Application
Sample PHP application that uses:

# Dependency Injection
Apache routing
Composer (aka: Not reinventing the wheel)
Docker for containerized deployment

# Requirements
Unix-like operating systems
Docker
Docker Compose
Apache
MariaDB/MySQL
Command line tools `make` & `wget`

# Setup
Clone the repository:

    git clone https://github.com/AlejandroArceRamos/php-sample-application-master.git
    cd php-sample-application-master
    Build and start the application using Docker Compose:

    docker-compose up --build
    Access the application:
    Open your browser and navigate to http://localhost:8080.

# Docker Configuration
The setup uses Docker to containerize the application, making it easy to deploy and manage. Below are the key configurations and steps:

# Dockerfile
The Dockerfile sets up a PHP 7.2 environment with Apache and necessary extensions, installs Composer, and sets up the virtual host configuration.

# docker-compose.yml
The Docker Compose file defines two services: php and db (MySQL). It sets up the necessary environment variables and volumes.

# vhost.conf
The vhost.conf file contains the Apache virtual host configuration, including rewrite rules for routing requests.

# Apache Configuration
The vhost.conf file should look like this:

    <Directory /var/www/html/web>
        AllowOverride All
    </Directory>

    <VirtualHost *:80>
        ServerAdmin webmaster@localhost
        DocumentRoot /var/www/html/web

    <Directory /var/www/html/web>
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined

    RewriteEngine On

    # GET http://localhost:8080/
    RewriteCond %{REQUEST_METHOD} =GET
    RewriteRule ^/$ /index.php [L]

    # GET http://localhost:8080/<user>
    RewriteCond %{REQUEST_METHOD} =GET
    RewriteRule ^/([^/]+)$ /user.php?user=$1 [L]

    # GET http://localhost:8080/<user>/status/<tweet>
    RewriteCond %{REQUEST_METHOD} =GET
    RewriteRule ^/([^/]+)/status/([^/]+)$ /tweet.php?user=$1&id=$2 [L]
</VirtualHost>

# Application Structure
src/: Contains the source code of the application.
web/: The document root for the application.
config/: Configuration files for the application, including vhost.conf.
sql/: SQL scripts for setting up the database.
Dockerfile: Dockerfile for building the PHP environment.
docker-compose.yml: Docker Compose configuration file.

# Database Setup
The application uses MySQL as the database. The necessary SQL script is located in the sql/ directory.
The database and user are automatically set up by Docker Compose using the db.sql file:

    CREATE DATABASE sample;
    CREATE USER 'sampleuser'@'%' IDENTIFIED BY 'samplepass';
    GRANT ALL PRIVILEGES ON sample.* TO 'sampleuser'@'%';
    FLUSH PRIVILEGES;

# Notes
Ensure Docker and Docker Compose are installed and running on your system.
The application is configured to run on port 8080. You can change this by modifying the docker-compose.yml file.
You are all set! Point your browser to http://localhost:8080 and start using the application.

Feel free to modify any sections as needed or to add additional details specific to your setup or requirements.
