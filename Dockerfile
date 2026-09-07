# ============================================================
# Stage 1: Install PHP dependencies
# ============================================================
FROM php:8.3-cli-bookworm AS composer

WORKDIR /app

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install system dependencies and PHP extensions required
# by Laravel and Composer packages
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        pdo_pgsql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        xml \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copy Composer files
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts


# ============================================================
# Stage 2: Build frontend assets
# ============================================================
FROM node:22-bookworm-slim AS frontend

WORKDIR /app

# Copy npm files first for Docker layer caching
COPY package.json package-lock.json ./

# Install frontend dependencies
RUN npm ci

# Copy frontend source files
COPY resources ./resources
COPY public ./public
COPY vite.config.* ./
COPY postcss.config.* ./

# Build Vite assets
RUN npm run build


# ============================================================
# Stage 3: Laravel application
# ============================================================
FROM php:8.3-cli-bookworm

WORKDIR /var/www/html

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        pdo_pgsql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        xml \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copy Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Copy Laravel application
COPY . .

# Copy Composer dependencies from Stage 1
COPY --from=composer /app/vendor ./vendor

# Copy compiled Vite assets from Stage 2
COPY --from=frontend /app/public/build ./public/build

# Create Laravel storage directories and set permissions
RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Clear Laravel caches
RUN php artisan config:clear || true \
    && php artisan route:clear || true \
    && php artisan view:clear || true

# Render provides the PORT environment variable
# Laravel listens on all interfaces so Render can access it
CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=${PORT:-10000}"]
