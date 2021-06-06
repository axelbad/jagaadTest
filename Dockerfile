FROM php:7-apache

# Copy application source
COPY . /var/www/html

RUN echo 'alias phpunit="./vendor/phpunit/phpunit/phpunit"' >> ~/.bashrc