FROM php:8.1-fpm

COPY wait-for-it.sh /usr/bin/wait-for-it

RUN chmod +x /usr/bin/wait-for-it

RUN apt-get update && \
    apt-get install -y --no-install-recommends libssl-dev zlib1g-dev curl git unzip netcat libxml2-dev libpq-dev libzip-dev && \
    pecl install apcu && \
    docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
    docker-php-ext-install -j$(nproc) zip opcache intl pdo_pgsql pgsql && \
    docker-php-ext-enable apcu pdo_pgsql sodium && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN curl https://deb.nodesource.com/setup_18.x | bash && \
    curl https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - && \
    echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list && \
    apt-get update
RUN apt-get install -y nodejs
RUN apt-get install yarn

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www


CMD composer i -o ; wait-for-it db:5432 -- bin/console doctrine:migrations:migrate ;  php-fpm

RUN composer require symfony/webpack-encore-bundle && yarn install 

RUN yarn add postcss-loader autoprefixer --dev && yarn add tailwindcss@npm:@tailwindcss/postcss7-compat @tailwindcss/postcss7-compat --dev && yarn install



EXPOSE 9000
