<?php

    if (isset ($_GET['password'])) {

        if (@ereg ("^[a-zA-Z0-9]+$", $_GET['password']) === FALSE)

            echo 'You password must be alphanumeric';

        else if (@strpos ($_GET['password'], '--') !== FALSE)

            require("flag.txt");

        else

        echo 'Invalid password';

        }
?>