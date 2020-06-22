FROM debian:stable

RUN apt-get update
RUN apt-get install -y composer \
    php-fpm \
    php-mysql \
    php-zip \
    php-xml \
    php-gd \
    php-imagick \
    php-curl \
    php-dev \
    php-mbstring

RUN service php7.3-fpm stop

RUN echo 'listen = 9000' >> /etc/php/7.3/fpm/pool.d/www.conf
RUN mkdir /run/php/
RUN mkdir -p /var/www

RUN useradd -ms /bin/bash noob
RUN usermod -a -G www-data noob
RUN chown -R www-data /var/www

RUN apt-get install -y lsb-base
RUN apt-get install -y netcat gcc make autoconf libc-dev pkg-config libmcrypt-dev

RUN pecl install mcrypt-1.0.2
RUN echo 'extension=mcrypt.so' >> /etc/php/7.3/fpm/php.ini
RUN echo 'extension=mcrypt.so' >> /etc/php/7.3/cli/php.ini

RUN curl -sL https://deb.nodesource.com/setup_12.x | bash -
RUN apt-get update && apt-get install -y nodejs


RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list
RUN apt-get update && apt-get -y install yarn

RUN apt-get install -y curl \
    gnupg \
    python \
    build-essential \
    libpcap-dev \
    gradle \
    wget \
    unzip

RUN sed -i s:www-data:noob:g /etc/php/7.3/fpm/*/*
