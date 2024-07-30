#!/bin/bash

# Define variables
WORDPRESS_PATH="/opt/bitnami/wordpress"
PLUGINS_SOURCE_PATH="$(pwd)/php/wordpress/plugins"
ACTIVATE_PLUGINS=("vibebp" "wplms-plugin" "wplms-pdf-certificates") # Replace with your actual plugin names

# Function to check the success of a command and exit if it fails
check_success() {
    if [ $? -ne 0 ]; then
        echo "Error: $1"
        exit 1
    fi
}

# Copy plugins to WordPress plugins directory
echo "Copying plugins..."
sudo cp -r $PLUGINS_SOURCE_PATH/* $WORDPRESS_PATH/wp-content/plugins/
check_success "Failed to copy plugins."

# Validate WP-CLI installation
echo "Validating WP-CLI installation..."
wp --info --path=$WORDPRESS_PATH
check_success "WP-CLI is not installed correctly."

# Activate specified plugins
for PLUGIN in "${ACTIVATE_PLUGINS[@]}"
do
    echo "Activating plugin: $PLUGIN"
    wp plugin activate $PLUGIN --path=$WORDPRESS_PATH
    check_success "Failed to activate plugin: $PLUGIN"
done

echo "Plugins installed and activated successfully."
