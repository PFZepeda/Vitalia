#!/bin/bash

# Copiar configuración de Nginx
echo "Copiando nginx.conf..."
cp /home/site/wwwroot/nginx.conf /etc/nginx/sites-available/default

# Intentar detectar el socket de PHP-FPM si existe, o usar 127.0.0.1:9000
# Azure PHP 8.x suele usar /var/run/php/php-fpm.sock o similar
PHP_FPM_SOCKET=$(find /var/run/php/ -name "php*-fpm.sock" | head -n 1)

if [ -z "$PHP_FPM_SOCKET" ]; then
    echo "No se encontró socket PHP-FPM, se usará 127.0.0.1:9000 en nginx.conf"
    sed -i "s|fastcgi_pass .*|fastcgi_pass 127.0.0.1:9000;|g" /etc/nginx/sites-available/default
else
    echo "Socket detectado: $PHP_FPM_SOCKET. Actualizando nginx.conf..."
    sed -i "s|fastcgi_pass .*|fastcgi_pass unix:$PHP_FPM_SOCKET;|g" /etc/nginx/sites-available/default
fi

# Permisos de carpetas
echo "Ajustando permisos..."
chmod -R 775 /home/site/wwwroot/storage /home/site/wwwroot/bootstrap/cache
chown -R www-data:www-data /home/site/wwwroot/storage /home/site/wwwroot/bootstrap/cache

# Reiniciar Nginx
echo "Reiniciando Nginx..."
service nginx restart

# Caché de Laravel
echo "Optimizando Laravel..."
php /home/site/wwwroot/artisan config:cache
php /home/site/wwwroot/artisan route:cache
php /home/site/wwwroot/artisan view:cache
