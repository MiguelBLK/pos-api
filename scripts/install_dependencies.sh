# Execute composer install
composer install

# Allow URL rewrites
sed -i 's#AllowOverride None#AllowOverride All#' /etc/apache2/apache2.conf

# Change apache document root
sed -i 's#DocumentRoot "/var/www/html"#DocumentRoot "/var/www/html/pos-api/public"#' /etc/apache2/apache2.conf

# Restart apache
service apache2 restart
