<?php

    namespace IdnoPlugins\CleverCustomize {

        class Main extends \Idno\Common\Plugin {

            function registerPages() {
                // register timeline, activity, and on this day pages
                \Idno\Core\site()->addPageHandler('/timeline', '\IdnoPlugins\CleverCustomize\Pages\Timeline');
                \Idno\Core\site()->addPageHandler('/activity', '\IdnoPlugins\CleverCustomize\Pages\Activity');
                \Idno\Core\site()->addPageHandler('/onthisday/([0-9]+)/([0-9]+)/?', '\IdnoPlugins\CleverCustomize\Pages\OnThisDay');
                \Idno\Core\site()->addPageHandler('/onthisday/', '\IdnoPlugins\CleverCustomize\Pages\OnThisDay');
                \Idno\Core\site()->addPageHandler('/8675', '\IdnoPlugins\CleverCustomize\Pages\Jenny');

                // override header
                \Idno\Core\Idno::site()->template()->replaceTemplate('shell/toolbar/main','clevercustomize/toolbar');
            }
        
        }

    }
