<?php

    namespace IdnoPlugins\CleverCustomize {

        class Main extends \Idno\Common\Plugin {

            function registerPages() {
                \Idno\Core\site()->addPageHandler('/timeline/', '\IdnoPlugins\CleverCustomize\Pages\Timeline');
                \Idno\Core\site()->addPageHandler('/activity/', '\IdnoPlugins\CleverCustomize\Pages\Activity');
                \Idno\Core\site()->addPageHandler('/onthisday/([0-9]+)/([0-9]+)/?', '\IdnoPlugins\CleverCustomize\Pages\OnThisDay');
                \Idno\Core\site()->addPageHandler('/onthisday/', '\IdnoPlugins\CleverCustomize\Pages\OnThisDay');
            }
        
        }

    }
