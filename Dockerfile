FROM tomsik68/xampp:latest

RUN rm -R /opt/lampp/htdocs/*
COPY . /opt/lampp/htdocs

# create database
WORKDIR /opt/lampp/var/mysql/
RUN mkdir gamebet
RUN chmod -R a+rwx gamebet

WORKDIR /opt/lampp/htdocs
RUN chmod +x db-init.sh