FROM medicean/vulapps:base_lamp

MAINTAINER mxh <mxh_xxx@yeah.net>

COPY abf20c91a442da48 /var/www/html/abf20c91a442da48/
COPY 5d47c5d8a6299792 /var/www/html/5d47c5d8a6299792/
COPY 3965659da7442e54 /var/www/html/3965659da7442e54/

WORKDIR /var/www/html

RUN rm -f /var/www/html/index.html /var/www/html/phpinfo.php

RUN chmod a+x -R abf20c91a442da48/
RUN chmod a+x -R 5d47c5d8a6299792/
RUN chmod a+x -R 3965659da7442e54/

