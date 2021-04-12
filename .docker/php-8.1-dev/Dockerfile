FROM alpine:3.13

ENV COMMON_DEPS \
        curl \
        gcc \
        make \
        cmake \
        autoconf \
        libc-dev

ENV RAYLIB_DEPS \
        libx11-dev \
        libxcursor-dev \
        libxrandr-dev \
        libxinerama-dev \
        libxi-dev \
        linux-headers \
        glfw-dev

ENV PHP_DEPS \
        bison \
        re2c \
        libxml2-dev \
        openssl-dev \
        pkgconf \
        libffi-dev \
        oniguruma-dev

RUN apk add --no-cache $COMMON_DEPS $RAYLIB_DEPS $PHP_DEPS

ENV RAYLIB_SRC_URL="https://github.com/raysan5/raylib/archive/refs/tags/3.5.0.zip"

RUN cd /opt && \
        curl -o raylib-3.5.0.zip -L $RAYLIB_SRC_URL && \
        unzip raylib-3.5.0.zip && \
        cd raylib-3.5.0/src && \
        make PLATFORM=PLATFORM_DESKTOP RAYLIB_LIBTYPE=SHARED && \
        make install RAYLIB_LIBTYPE=SHARED

ENV CONFIGURE_OPTS \
        --disable-all \
        --with-ffi \
        --enable-phar \
        --enable-tokenizer \
        --with-libxml \
        --with-iconv \
        --with-openssl \
        --enable-mbstring \
        --enable-xmlwriter \
        --enable-simplexml \
        --enable-filter \
        --enable-dom

ENV PHP_SRC_URL="https://github.com/php/php-src/archive/refs/heads/master.zip"
RUN cd /opt && \
        curl -L -o php.zip $PHP_SRC_URL && \
        unzip php.zip && \
        rm php.zip && \
        cd php-src-master && \
        ./buildconf && \
        ./configure $CONFIGURE_OPTS && \
        make -j8 && \
        make install

ENTRYPOINT ["php"]

