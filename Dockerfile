FROM php:8.1

WORKDIR /var/www/html 

# Install system dependencies
RUN apt-get update && apt-get install -y \
  libzip-dev \
  zip \
  git \
  wget \
  xfonts-75dpi \
  xfonts-base \
  libxrender1 \
  libxext6 \
  fontconfig \
  wkhtmltopdf

# Install php extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- \
  --install-dir=/usr/bin --filename=composer

COPY . /var/www/html 

RUN composer install --ignore-platform-reqs

# Give execute permission to startup script
RUN chmod +x /var/www/html/docker-startup.sh

ENTRYPOINT [ "/var/www/html/docker-startup.sh" ]

