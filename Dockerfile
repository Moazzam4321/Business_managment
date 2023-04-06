FROM ubuntu:20.4

RUN apt-get update -y 
RUN apt-get install nginx php8.1-fpm -y

RUN apt-get update -y
RUN apt-get install nginx php8.1-mongodb

WORKDIR /var/www/

COPY ./MANAGMENT_SYSTEM/ .

COPY ./config1/Nginx /etc/nginx/sites=enabled

CMD /etc/init.d/php8.1-fpm && nginx -g "daemon off;"

EXPOSE 80
