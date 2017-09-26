FROM medicean/vulapps:base_lamp

MAINTAINER mxh <mxh_xxx@yeah.net>

COPY 8f971f70a8d046ab /var/www/html/8f971f70a8d046ab/
COPY d9a92ae7020043e9 /var/www/html/d9a92ae7020043e9/
COPY 9763f1b840ce1284 /var/www/html/9763f1b840ce1284/

WORKDIR /var/www/html

RUN rm -f /var/www/html/index.html /var/www/html/phpinfo.php

RUN chmod a+x -R 8f971f70a8d046ab/
RUN chmod a+x -R d9a92ae7020043e9/
RUN chmod a+x -R 9763f1b840ce1284/

