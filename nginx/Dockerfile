FROM debian:stretch
RUN apt-get update
RUN apt-get install -y nano curl wget net-tools util-linux apt-utils

RUN apt-get install -y \
	nginx

RUN mkdir /mnt/www
RUN chown www-data:www-data /mnt/www
