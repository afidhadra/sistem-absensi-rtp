FROM php:8.4-cli

# Install Node.js for npm build
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && pecl install redis && docker-php-ext-enable redis \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /app

# Copy composer files first for better caching
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts --ignore-platform-reqs

# Copy everything else
COPY . .

# Build frontend assets
RUN npm install && npm run build

# Setup storage directories + permissions
RUN mkdir -p storage/framework/{sessions,views,cache} \
    storage/logs \
    bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Generate autoload
RUN composer dump-autoload --optimize --no-scripts

EXPOSE 8000

CMD ["sh", "-c", "php artisan migrate --force 2>&1 && php artisan db:seed --force 2>&1; php artisan serve --host=0.0.0.0 --port=$PORT 2>&1"]
