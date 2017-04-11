<?php

    namespace IdnoPlugins\CleverCustomize\Pages {

        class Timeline extends \Idno\Pages\Homepage
        {

            function getContent()
            {
                $this->arguments[0] = '/bookmarkedpages/statusupdates';
                return parent::getContent();
            }

        }

    }
