FROM medicean/vulapps:base_lamp

MAINTAINER mxh <mxh_xxx@yeah.net>

COPY 8f971f70a8d046ab /var/www/html/8f971f70a8d046ab/
COPY d9a92ae7020043e9 /var/www/html/d9a92ae7020043e9/
COPY 9763f1b840ce1284 /var/www/html/9763f1b840ce1284/
COPY 46b9a49091a02707 /var/www/html/46b9a49091a02707/
COPY 12d686301527a029 /var/www/html/12d686301527a029/
COPY 99b202162de3248c /var/www/html/99b202162de3248c/
COPY c28379aac7444db8 /var/www/html/c28379aac7444db8/

WORKDIR /var/www/html

RUN rm -f /var/www/html/index.html /var/www/html/phpinfo.php

RUN chmod a+x -R 8f971f70a8d046ab/
RUN chmod a+x -R d9a92ae7020043e9/
RUN chmod a+x -R 9763f1b840ce1284/

RUN chmod a+x -R 46b9a49091a02707/
RUN chmod a+x -R 12d686301527a029/
RUN chmod a+x -R 99b202162de3248c/
RUN chmod a+x -R c28379aac7444db8/

