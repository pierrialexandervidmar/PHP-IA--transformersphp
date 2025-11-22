FROM php:8.3-cli

# Permite que o Composer rode plugins mesmo sendo root (normal em Docker)
ENV COMPOSER_ALLOW_SUPERUSER=1

# Dependências e extensões do PHP
RUN apt update && apt install -y \
    libffi-dev \
    libz-dev \
    libpng-dev \
    git \
    libzip-dev \
 && docker-php-ext-install ffi sockets gd pcntl zip

 # Habilita OPcache + JIT também para CLI
RUN { \
    echo 'opcache.enable=1'; \
    echo 'opcache.enable_cli=1'; \
    echo 'opcache.jit_buffer_size=128M'; \
    echo 'opcache.jit=tracing'; \
} > /usr/local/etc/php/conf.d/jit.ini

# útil pra IA, aumenta limite de memória do PHP
RUN echo 'memory_limit=1G' > /usr/local/etc/php/conf.d/memory-limit.ini

# Composer
COPY --from=composer:2.5.8 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copia seus arquivos (incluindo test.php) para dentro da imagem
COPY . /app

# Instala o TransformersPHP e baixa o modelo de sentimento
RUN composer require codewithkyrian/transformers \
 && ./vendor/bin/transformers download Xenova/distilbert-base-uncased-finetuned-sst-2-english sentiment-analysis
