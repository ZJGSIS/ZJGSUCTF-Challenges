FROM phusion/baseimage:latest

RUN sed -i -re 's/([a-z]{2}\.)?archive.ubuntu.com|security.ubuntu.com/mirrors.tuna.tsinghua.edu.cn/g' /etc/apt/sources.list && apt-get update && apt-get install -y python-software-properties && add-apt-repository ppa:ondrej/php && apt-get update

RUN apt-get install -y php5.6 php5.6-mbstring php5.6-curl php5.6-cli php5.6-mysql php5.6-soap libapache2-mod-php5.6 mariadb-server apache2 gcc netcat-traditional && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /var/www/html/*

COPY php.ini /etc/php/5.6/apache2/php.ini
RUN mkdir -p /etc/service/apache2/ && \
    printf "#!/bin/sh\n\nexec /usr/sbin/apachectl -D FOREGROUND\n" > /etc/service/apache2/run && \
    mkdir -p /etc/service/mysql/ && \
    printf "#!/bin/sh\n\nexec /usr/bin/mysqld_safe\n" > /etc/service/mysql/run && \
    mkdir -p /var/run/mysqld/ && chown mysql:mysql /var/run/mysqld && \
    chmod 700 /etc/service/mysql/run /etc/service/apache2/run

COPY src/ /var/www/html
RUN /etc/init.d/mysql start &&\
    mysql -e "grant all privileges on *.* to 'root'@'%' identified by 'toor';"&&\
    mysql -e "grant all privileges on *.* to 'root'@'localhost' identified by 'toor';"&&\
    mysql -uroot -ptoor  < /var/www/html/test.sql

RUN chmod 777 /var/www/html/admin 

EXPOSE 80
