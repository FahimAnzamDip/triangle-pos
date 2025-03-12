# Use Ubuntu 20.04 as the base image
FROM ubuntu:20.04

WORKDIR /app

# Set non-interactive frontend for apt (to avoid timezone configuration prompt)
ENV DEBIAN_FRONTEND=noninteractive

# Install system dependencies
RUN apt-get update && apt-get install -y \
  software-properties-common \
  curl \
  libzip-dev \
  zip \
  git \
  wget \
  xfonts-75dpi \
  xfonts-base \
  libxrender1 \
  libxext6 \
  fontconfig \
  libssl1.1


# Add the Ondřej Surý PPA for PHP 8.x
RUN add-apt-repository ppa:ondrej/php -y && \
apt-get update

# Install PHP 8.x and required extensions
RUN apt-get install -y \
php8.1 \
php8.1-mysql \
php8.1-zip \
php8.1-xml \
php8.1-mbstring \
php8.1-curl \
php8.1-bcmath

# Install wkhtmltopdf
RUN wget https://github.com/wkhtmltopdf/packaging/releases/download/0.12.6-1/wkhtmltox_0.12.6-1.focal_arm64.deb && \
  dpkg -i wkhtmltox_0.12.6-1.focal_arm64.deb || apt-get install -f -y

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Copy application files
COPY . /app

# Install Composer dependencies
RUN composer install --ignore-platform-reqs

# Give execute permission to startup script
RUN chmod +x /app/docker-startup.sh

ENTRYPOINT [ "/app/docker-startup.sh" ]