FROM registry.cn-hangzhou.aliyuncs.com/sandbox3/php:7.0-ubuntu

MAINTAINER <account@sandbox3.cn>

# copy code
COPY ./ /root/

#ADD entrypoint.sh /root
RUN chmod +x /root/entrypoint.sh

WORKDIR /root

EXPOSE 2015

ENTRYPOINT ["/root/entrypoint.sh"]