# Build stage for Node.js
FROM node:20-alpine AS node-builder

WORKDIR /app

# Copy only files needed for npm
COPY package.json package-lock.json* ./
# Install all dependencies (including dev) for build
RUN npm ci && npm cache clean --force

# Copy files needed for build
COPY vite.config.js tailwind.config.js postcss.config.js* ./
COPY resources ./resources
COPY public ./public

# Build frontend assets
RUN npm run build

# Main image
FROM php:8.4-cli-alpine

# Install system dependencies (including build dependencies)
RUN apk add --no-cache \
    postgresql-dev \
    postgresql-libs \
    libzip-dev \
    zip \
    unzip \
    curl \
    git \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    oniguruma-dev \
    icu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        zip \
        pdo \
        pdo_pgsql \
        gd \
        mbstring \
        intl \
    && apk del --no-cache \
        freetype-dev \
        libjpeg-turbo-dev \
        libpng-dev \
        icu-dev \
    && apk add --no-cache \
        libpng \
        libjpeg-turbo \
        freetype \
        icu-libs

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy composer files separately for caching
COPY composer.json composer.lock ./

# Install PHP dependencies (cached if composer.json hasn't changed)
# Use --prefer-dist to avoid using git
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --optimize-autoloader && \
    composer clear-cache

# Copy remaining files (excluding node_modules and vendor, which are already installed)
COPY . .

# Copy built files from node-builder (overwrites if exists)
COPY --from=node-builder /app/public/build ./public/build

# Complete composer setup and generate autoloader
RUN composer dump-autoload --optimize --classmap-authoritative --no-dev

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Install make and bash
RUN apk add --no-cache make bash

EXPOSE 8000

# Use PORT environment variable for Render.com, default to 8000
CMD ["bash", "-c", "make start"]