<?php

    namespace IdnoPlugins\CleverCustomize\Pages {

        class Jenny extends \Idno\Common\Page
        {

            function getContent()
            {
                header("HTTP/1.1 309 Don't Change Your Number");
                header('Location: tel://+1-443-453-3116');
                echo('<a href="tel://+14434533116">443-453-3116</a>');
                $this->setResponse(309);
            }

        }

    }
