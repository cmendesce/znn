# Build image
FROM golang:1.9-alpine as builder

ARG CADDY_VERSION="0.10.10"

RUN apk add --no-cache git

# clone caddy
RUN git clone https://github.com/mholt/caddy -b "v$CADDY_VERSION" /go/src/github.com/mholt/caddy \
    && cd /go/src/github.com/mholt/caddy \
    && git checkout -b "v$CADDY_VERSION"

# import plugins
COPY ./caddy/plugins.go /go/src/github.com/mholt/caddy/caddyhttp/plugins.go

# clone builder
RUN git clone https://github.com/caddyserver/builds /go/src/github.com/caddyserver/builds

# build caddy
RUN cd /go/src/github.com/mholt/caddy/caddy \
    && go get ./... \
    && go run build.go \
    && mv caddy /go/bin

# Dist image
FROM alpine:3.8

# install deps
RUN apk add --no-cache --no-progress curl tini ca-certificates

# PHP www-user UID and GID
ARG PUID="1000"
ARG PGID="1000"

RUN apk add --no-cache openssh-client git tar php7-fpm curl

# essential php libs
RUN apk add --no-cache php7-curl php7-dom php7-gd php7-ctype php7-zip php7-xml php7-xmlreader php7-xmlwriter php7-iconv php7-sqlite3 php7-mysqli php7-pgsql php7-json php7-phar php7-openssl php7-pdo php7-pdo_mysql php7-session php7-mbstring php7-bcmath php7-tokenizer php7-fileinfo

# symblink php7 to php
RUN ln -sf /usr/bin/php7 /usr/bin/php

# symlink php-fpm7 to php-fpm
RUN ln -sf /usr/bin/php-fpm7 /usr/bin/php-fpm

# add a php www-user instead of nobody
RUN addgroup -g ${PGID} www-user && \
  adduser -D -H -u ${PUID} -G www-user www-user && \
  sed -i "s|^user = .*|user = www-user|g" /etc/php7/php-fpm.d/www.conf && \
  sed -i "s|^group = .*|group = www-user|g" /etc/php7/php-fpm.d/www.conf

# composer
RUN curl --silent --show-error --fail --location \
  --header "Accept: application/tar+gzip, application/x-gzip, application/octet-stream" \
  "https://getcomposer.org/installer" \
  | php -- --install-dir=/usr/bin --filename=composer

# allow environment variable access.
RUN echo "clear_env = no" >> /etc/php7/php-fpm.conf

# copy caddy binary
COPY --from=builder /go/bin/caddy /usr/bin/caddy

# list plugins
RUN /usr/bin/caddy -plugins

# static files volume
VOLUME ["/www"]
WORKDIR /www
 
EXPOSE 80 443 2015 9180

ARG BUILDTIME_FIDELITY
ENV FIDELITY=$BUILDTIME_FIDELITY

COPY ./caddy/Caddyfile /etc/caddy/Caddyfile

COPY . /www/

ENTRYPOINT ["/sbin/tini", "--"]
CMD ["caddy", "-agree", "--conf", "/etc/caddy/Caddyfile"]