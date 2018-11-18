FROM ubuntu:16.04

RUN apt-get update

RUN apt-get install -y apache2 mysql-server php libapache2-mod-php php-mcrypt php-mysql
