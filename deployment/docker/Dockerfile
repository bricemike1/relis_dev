FROM debian:stretch

ARG DIRECTORY_INDEX
ARG DOCUMENT_ROOT

RUN apt-get autoclean
RUN apt-get update && apt-get install -y \
    apt-transport-https \
    ca-certificates \
    curl \
    software-properties-common \
    vim \
    gnupg \
    wget \
    ksh \
    unzip \
    zip \
    git

RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php7.3.list

RUN apt-get update
RUN apt-get install -y apache2 \
    mysql-server \
    php7.1

RUN update-alternatives --set php /usr/bin/php7.1

RUN apt-get install -y php7.1-xml \
    php7.1-mbstring \
    php7.1-dev \
    php7.1-intl \
    php-pear \
    php7.1-mysql\
    php7.1-sqlite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

## Make a lsb-release file so the installer knows the os (necessary for debian)
RUN cp /etc/os-release /etc/lsb-release

## Create and switch user for a non-root installation
RUN useradd -ms /bin/bash docker
USER docker

USER root

#Set php.ini configuration
RUN rm /etc/php/7.1/apache2/php.ini
COPY ./php/conf/apache/php.ini /etc/php/7.1/apache2/php.ini
COPY ./php/conf/cli/php.ini  /etc/php/7.1/cli/php.ini

# Set apache vhost
RUN echo ${DIRECTORY_INDEX}
RUN echo ${DOCUMENT_ROOT}
COPY ./apache/conf/vhost.conf /etc/apache2/sites-available
RUN sed -i -e "s|__DIRECTORY_INDEX__|${DIRECTORY_INDEX}|g" /etc/apache2/sites-available/vhost.conf
RUN sed -i -e "s|__DOCUMENT_ROOT__|${DOCUMENT_ROOT}|g" /etc/apache2/sites-available/vhost.conf
RUN ln -s /etc/apache2/sites-available/vhost.conf /etc/apache2/sites-enabled/vhost.conf
RUN rm /etc/apache2/sites-enabled/000-default.conf

RUN service mysql start && echo 'update user set plugin = "" where User = "root"; flush privileges;' | mysql -uroot mysql

RUN a2enmod rewrite
COPY ./entrypoint.sh /usr/local/bin
RUN sed 's/\r$//g' /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

WORKDIR ${DOCUMENT_ROOT}