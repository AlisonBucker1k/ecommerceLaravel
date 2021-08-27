FROM phpdockerio/php74-fpm:latest

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install php-memcached php7.4-mysql php7.4-pgsql php7.4-curl php-redis php7.4-sqlite3 php7.4-bcmath php7.4-bz2 php7.4-enchant php7.4-gd php7.4-gmp php7.4-imap php7.4-intl php7.4-mbstring php7.4-pspell php7.4-soap php-ssh2 php7.4-tidy php7.4-xsl php-yaml php-xdebug php-zmq \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
