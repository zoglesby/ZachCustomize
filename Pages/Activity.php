<?php

    namespace IdnoPlugins\CleverCustomize\Pages {

        class Activity extends \Idno\Pages\Homepage
        {

            function getContent()
            {
                $this->arguments[0] = '/locations/food/watching';
                return parent::getContent();
            }

        }

    }
