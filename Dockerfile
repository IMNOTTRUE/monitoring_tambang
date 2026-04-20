FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
# install node
RUN apt-get update && apt-get install -y nodejs npm

# build vite
RUN npm install && npm run build
COPY . .

RUN composer install --no-interaction --optimize-autoloader

CMD php artisan migrate --force || echo "MIGRATE GAGAL" && php artisan serve --host=0.0.0.0 --port=8000