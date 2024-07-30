#!/bin/bash

# Define variables with default values
URL="https://44dev.com"
TITLE="44dev.com"
ADMIN_USER="admin"
ADMIN_PASSWORD="adminpassword"
ADMIN_EMAIL="info@44dev.com"
DB_NAME="your_database_name"
DB_USER="your_database_user"
DB_PASSWORD="your_database_password"
DB_HOST="your_database_host"
WORDPRESS_PATH="/opt/bitnami/wordpress"
FORCE=true

# Function to check the success of a command and exit if it fails
check_success() {
    if [ $? -ne 0 ]; then
        echo "Error: $1"
        exit 1
    fi
}

# Parse command-line arguments to override default values
while [[ "$#" -gt 0 ]]; do
    case $1 in
        --url) URL="$2"; shift ;;
        --title) TITLE="$2"; shift ;;
        --admin_user) ADMIN_USER="$2"; shift ;;
        --admin_password) ADMIN_PASSWORD="$2"; shift ;;
        --admin_email) ADMIN_EMAIL="$2"; shift ;;
        --db_name) DB_NAME="$2"; shift ;;
        --db_user) DB_USER="$2"; shift ;;
        --db_password) DB_PASSWORD="$2"; shift ;;
        --db_host) DB_HOST="$2"; shift ;;
        --force) FORCE=true ;;
        *) echo "Unknown parameter passed: $1"; exit 1 ;;
    esac
    shift
done

# Install WP-CLI
echo "Downloading WP-CLI..."
curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
check_success "Failed to download WP-CLI."

echo "Making WP-CLI executable..."
chmod +x wp-cli.phar
check_success "Failed to make WP-CLI executable."

echo "Moving WP-CLI to /usr/local/bin/wp..."
sudo mv wp-cli.phar /usr/local/bin/wp
check_success "Failed to move WP-CLI to /usr/local/bin/wp."

# Validate WP-CLI installation
echo "Validating WP-CLI installation..."
wp --info
check_success "WP-CLI is not installed correctly."

if [ "$FORCE" = true ]; then
    # Remove existing WordPress installation if it exists
    if [ -d "$WORDPRESS_PATH" ] && [ -n "$(ls -A $WORDPRESS_PATH)" ]; then
        echo "Force parameter detected: Removing existing WordPress files..."
        sudo rm -rf ${WORDPRESS_PATH}/*
        check_success "Failed to remove existing WordPress files."
    else
        echo "No WordPress files to remove."
    fi

    # Drop existing database tables if they exist
    if [ -f "$WORDPRESS_PATH/wp-config.php" ]; then
        echo "Dropping existing WordPress database tables..."
        wp db reset --yes --path=$WORDPRESS_PATH
        check_success "Failed to drop existing database tables."
    else
        echo "No existing WordPress installation detected at $WORDPRESS_PATH."
    fi
else
    echo "No force parameter detected: Skipping file removal and database reset."
fi

# Download and install WordPress
echo "Downloading WordPress..."
wp core download --path=$WORDPRESS_PATH
check_success "Failed to download WordPress."

# Create a new configuration file
echo "Creating a new wp-config.php file..."
wp config create --dbname=$DB_NAME --dbuser=$DB_USER --dbpass=$DB_PASSWORD --dbhost=$DB_HOST --path=$WORDPRESS_PATH
check_success "Failed to create wp-config.php."

# Install WordPress if it's not already installed
if ! wp core is-installed --path=$WORDPRESS_PATH; then
    echo "Installing WordPress..."
    wp core install --url="$URL" --title="$TITLE" --admin_user="$ADMIN_USER" --admin_password="$ADMIN_PASSWORD" --admin_email="$ADMIN_EMAIL" --skip-email --path=$WORDPRESS_PATH
    check_success "Failed to install WordPress."
else
    echo "WordPress is already installed."
fi

# Restart services
echo "Restarting services..."
sudo /opt/bitnami/ctlscript.sh restart
check_success "Failed to restart services."

# Output instructions for Let's Encrypt SSL certificate
echo "WordPress reinstallation completed successfully."
echo "To obtain a Let's Encrypt SSL certificate, run the following command:"
echo "sudo /opt/bitnami/bncert-tool"
echo "Follow the prompts to configure your SSL certificate for your domain."
