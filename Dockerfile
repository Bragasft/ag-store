# Usa a imagem oficial do PHP com Apache
FROM php:8.2-apache

# Copia todos os arquivos do seu projeto para o diretório padrão do Apache
COPY . /var/www/html/

# Dá permissão correta para os arquivos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Ativa o módulo de reescrita do Apache (necessário para .htaccess)
RUN a2enmod rewrite

# Expõe a porta padrão do Apache
EXPOSE 80
