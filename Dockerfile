# Use the official PHP image with CLI
FROM php:8.3-cli-alpine3.21

# Install dependencies
RUN apk add --no-cache \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    curl \
    mysql-client \
    git

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) gd pdo pdo_mysql zip pcntl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Create working directory
WORKDIR /var/www/html

# Copy composer files first for better layer caching
COPY composer.json composer.lock ./

# Install Laravel dependencies (no-dev for production)
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Copy the rest of the application
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 8000 for artisan serve
EXPOSE 8001

# Start the development server
CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=8001"]