FROM medicean/vulapps:base_lamp

MAINTAINER mxh <mxh_xxx@yeah.net>

COPY abf20c91a442da48 /var/www/html/abf20c91a442da48/
COPY 5c55674b83536ad3 /var/www/html/5c55674b83536ad3/
COPY 9630e9ba0442fa3a /var/www/html/9630e9ba0442fa3a/

WORKDIR /var/www/html

RUN rm -f /var/www/html/index.html /var/www/html/phpinfo.php

RUN chmod a+x -R abf20c91a442da48/
RUN chmod a+x -R 5c55674b83536ad3/
RUN chmod a+x -R 9630e9ba0442fa3a/
