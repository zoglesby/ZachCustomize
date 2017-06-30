<?php

    namespace IdnoPlugins\CleverCustomize\Pages {

        class Jenny extends \Idno\Common\Page
        {

            function getContent()
            {
                header("HTTP/1.1 309 Don't Change Your Number");
                header('Location: tel://+1-503-567-8642');
                echo('<a href="tel://+15035678642">503-567-8642</a>');
                $this->setResponse(309);
            }

        }

    }
