#!/bin/bash

# Define variables
WORDPRESS_PATH="/opt/bitnami/wordpress"
THEMES_SOURCE_PATH="$(pwd)/php/wordpress/themes"
ACTIVE_THEME="wplms-child-theme"

# Function to check the success of a command and exit if it fails
check_success() {
    if [ $? -ne 0 ]; then
        echo "Error: $1"
        exit 1
    fi
}

# Copy themes to WordPress themes directory
echo "Copying themes..."
sudo cp -r $THEMES_SOURCE_PATH/* $WORDPRESS_PATH/wp-content/themes/
check_success "Failed to copy themes."

# Validate WP-CLI installation
echo "Validating WP-CLI installation..."
wp --info --path=$WORDPRESS_PATH
check_success "WP-CLI is not installed correctly."

# Activate the specified theme
echo "Activating theme: $ACTIVE_THEME"
wp theme activate $ACTIVE_THEME --path=$WORDPRESS_PATH
check_success "Failed to activate theme."

echo "Themes installed and activated successfully."
