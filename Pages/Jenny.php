<?php

    namespace IdnoPlugins\CleverCustomize\Pages {

        class Jenny extends \Idno\Common\Page
        {

            function getContent()
            {
                header("HTTP/1.1 309 Don't Change Your Number");
                header('Location: tel://+1-404-784-1081');
                echo('<a href="tel://+14047841081">404-784-1081</a>');
                $this->setResponse(309);
            }

        }

    }
