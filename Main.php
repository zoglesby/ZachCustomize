<?php

    namespace IdnoPlugins\CleverCustomize {

        class Main extends \Idno\Common\Plugin {

            function registerPages() {
                \Idno\Core\site()->addPageHandler('/timeline/', '\IdnoPlugins\CleverCustomize\Pages\Timeline');
                \Idno\Core\site()->addPageHandler('/activity/', '\IdnoPlugins\CleverCustomize\Pages\Activity');
            }
        
        }

    }
