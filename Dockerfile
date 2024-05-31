FROM php:apache

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

# Cambiar propietario y permisos
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]
