FROM medicean/vulapps:base_lamp

MAINTAINER mxh <mxh_xxx@yeah.net>

COPY challenges /var/www/html/

WORKDIR /var/www/html

RUN rm -f /var/www/html/index.html /var/www/html/phpinfo.php && \
chmod a+x -R abf20c91a442da48/ && \
chmod a+x -R 5c55674b83536ad3/ && \
chmod a+x -R 9630e9ba0442fa3a/ && \
chmod a+x -R c569d1f25f24fc39/
