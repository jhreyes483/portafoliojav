FROM php:7.3-apache

# Instalar dependencias
RUN apt-get update && \
    apt-get install -y zlib1g-dev libzip-dev \
    git \
    zip \
    libonig-dev \
    libxml2-dev \
    libgd3 \
    libgd-dev \
    curl \
    nano

# Instalar extensiones PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath opcache gd zip mysqli

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Instalar Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

# Instalar Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && apt-get install -y nodejs

# Configurar Apache para el archivo index.php en la raíz del proyecto
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Copiar solo el archivo index.php a la raíz del directorio del servidor web
COPY . /var/www/html/
RUN docker-php-ext-install session
# Cambiar propietario y permisos
RUN mkdir -p /var/www/html/session
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

#RUN pecl install redis && docker-php-ext-enable redis

# Configurar PHP para usar el directorio de sesión persistente
RUN echo "session.save_path = '/var/www/html/session'" > /usr/local/etc/php/conf.d/session.ini && \
    echo "session.cookie_lifetime = 86400" >> /usr/local/etc/php/php.ini && \
    echo "session.gc_maxlifetime = 86400" >> /usr/local/etc/php/php.ini && \
    echo "session.cookie_secure = 1" >> /usr/local/etc/php/php.ini && \
    echo "session.cookie_httponly = 1" >> /usr/local/etc/php/php.ini && \
    echo "session.cookie_samesite = 'Lax'" >> /usr/local/etc/php/php.ini && \
    echo "session.use_strict_mode = 1" >> /usr/local/etc/php/php.ini && \
    echo "session.use_only_cookies = 1" >> /usr/local/etc/php/php.ini && \
    echo "session.use_trans_sid = 0" >> /usr/local/etc/php/php.ini && \
    echo "session.sid_length = 48" >> /usr/local/etc/php/php.ini && \
    echo "session.sid_bits_per_character = 6" >> /usr/local/etc/php/php.ini \
    RUN echo "session.cookie_domain = 'fly.dev'" >> /usr/local/etc/php/php.ini

#$RUN chown -R www-data:www-data /var/www/html/session
RUN chmod -R 755 /var/www/html/session
EXPOSE 80
CMD ["apache2-foreground"]
