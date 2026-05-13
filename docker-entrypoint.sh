#!/bin/sh
set -e

# Configure Apache to use Render's PORT
sed -i "s/80/${PORT}/g" /etc/apache2/ports.conf
sed -i "s/:80/:${PORT}/g" /etc/apache2/sites-available/000-default.conf

exec "$@"
