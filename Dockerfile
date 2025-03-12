FROM php:8.1

WORKDIR /app

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
  fontconfig

# Install wkhtmltopdf
RUN wget https://github.com/wkhtmltopdf/packaging/releases/download/0.12.6-1/wkhtmltox_0.12.6-1.buster_amd64.deb && \
  dpkg -i wkhtmltox_0.12.6-1.buster_amd64.deb && \
  rm wkhtmltox_0.12.6-1.buster_amd64.deb

# Install php extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- \
  --install-dir=/usr/bin --filename=composer

COPY . /app

RUN composer install --ignore-platform-reqs

# Give execute permission to startup script
RUN chmod +x /app/docker-startup.sh

ENTRYPOINT [ "/app/docker-startup.sh" ]

