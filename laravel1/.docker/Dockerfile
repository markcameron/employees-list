# Base image for the container
FROM alpine:3.11.3@sha256:ddba4d27a7ffc3f86dd6c2f92041af252a1f23a8e742c90e6e1297bfa1bc0c45

# Labels
LABEL ch.ejpd.maintainer="Mark CAMERON mark.oliver.cameron@gmail.com>" \
    ch.ejpd.os="Alpine" \
    ch.ejpd.sourceurl="https://github/markcameron/employees-list" \
    ch.ejpd.manufacturer="DevFactory"

#Add PHP and Laravel necessary php extensions
RUN apk --no-cache add \
    nginx \
    curl \
    php7 \
    php7-fpm \
    php7-curl \
    php7-fileinfo \
    php7-gd \
    php7-json \
    php7-mbstring \
    php7-mysqli \
    php7-pdo \
    php7-pdo_pgsql \
    php7-session \
    php7-tokenizer \
    php7-zip \
    supervisor

# Configure nginx
COPY .docker/config/nginx.conf /etc/nginx/nginx.conf
# Remove default server definition
RUN rm /etc/nginx/conf.d/default.conf

# Configure PHP-FPM
COPY .docker/config/fpm-pool.conf /etc/php7/php-fpm.d/www.conf
COPY .docker/config/php.ini /etc/php7/conf.d/custom.ini

# Configure supervisord
COPY .docker/config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Setup document root
RUN mkdir -p /var/www/html

# Make sure files/folders needed by the processes are accessable when they run under the nobody user
RUN chown -R nobody.nobody /var/www/html && \
  chown -R nobody.nobody /run && \
  chown -R nobody.nobody /var/lib/nginx && \
#  chown -R nobody.nobody /var/tmp/nginx && \
  chown -R nobody.nobody /var/log/nginx

# Switch to use a non-root user from here on
USER nobody

# Add application
WORKDIR /var/www/html
COPY --chown=nobody . /var/www/html/
RUN rm -Rf /var/www/html/.docker
# Expose the port nginx is reachable on
EXPOSE 8080

# Let supervisord start nginx & php-fpm
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

# Configure a healthcheck to validate that everything is up&running
HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1:8080/fpm-ping
