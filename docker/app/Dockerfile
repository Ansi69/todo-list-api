FROM php:8.3-fpm

# Устанавливаем необходимые пакеты
RUN apt-get update && apt-get install -y \
    git curl unzip libmcrypt-dev mariadb-client \
    pkg-config librabbitmq-dev libssh-dev \
    libpng-dev libzip-dev libsqlite3-dev sqlite3 \
    && docker-php-ext-install opcache sockets gd zip pdo pdo_mysql pdo_sqlite \
    && pecl install amqp redis \
    && docker-php-ext-enable amqp redis pdo_mysql pdo_sqlite

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Создаём пользователя
ARG user=user
ARG uid=1000
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user && chown -R $user:$user /home/$user

# Опционально устанавливаем Xdebug
ARG XDEBUG=false
RUN if [ "$XDEBUG" = "true" ] ; then \
    pecl install xdebug-3.4.0 && \
    docker-php-ext-enable xdebug && \
    echo "xdebug.mode=coverage" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
else \
    echo 'Without xdebug'; \
fi

# Указываем рабочую директорию
WORKDIR /app

# Создаём файл базы данных SQLite (если его нет)
#RUN mkdir -p /app/database && touch /app/database/database.sqlite \
#    && chown -R $user:$user /app/database

USER $user
