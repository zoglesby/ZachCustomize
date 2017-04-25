<?php

    /**
     * Defines the site homepage
     */

    namespace IdnoPlugins\CleverCustomize\Pages {

        use Idno\Core\Webmention;
        use Idno\Entities\Notification;
        use Idno\Entities\User;

        /**
         * Default class to serve the homepage
         */
        class OnThisDay extends \Idno\Common\Page
        {

            // Handle GET requests to the homepage

            function getContent()
            {
                $query          = $this->getInput('q');
                $types          = $this->getInput('types');
                $friendly_types = array('all');

                // Check for an empty site
                if (!\Idno\Entities\User::get()) {
                    $this->forward(\Idno\Core\Idno::site()->config()->getURL() . 'begin/');
                }

                // Set the homepage owner for single-user sites
                if (!$this->getOwner() && \Idno\Core\Idno::site()->config()->single_user) {
                    $owners = \Idno\Entities\User::get(['admin' => true]);
                    if (count($owners) === 1) {
                        $this->setOwner($owners[0]);
                    } else {
                        \Idno\Core\Idno::site()->logging()->warning('Expected exactly 1 admin user for single-user site; got '.count($owners));
                    }
                }

                $types = \Idno\Common\ContentType::getRegisteredClasses();

                $search = array();
                if (!empty($query)) {
                    $search = \Idno\Core\Idno::site()->db()->createSearchArray($query);
                }

                $search['publish_status'] = 'published';

                /* identify target date */
                $target = 'today';
                
                if (!empty($this->arguments)) {
                    $target = date('Y-') . implode('-', $this->arguments);
                }

                $count = 0;
                $feed = array();
                for ($i = 1; $i < 20; $i++) {
                    $subsearch = $search;
                    
                    $start = strtotime($target . ' -' . $i . ' year');
                    $end = strtotime($target . ' -' . $i . ' year 1 day');
                    
                    $subsearch['created']['$gt'] = date('Y-m-d 00:00:00', $start);
                    $subsearch['created']['$lt'] = date('Y-m-d 23:59:59', $end);  
                    
                    $subcount = \Idno\Common\Entity::countFromX($types, $subsearch);
                    $subfeed = \Idno\Common\Entity::getFromX($types, $subsearch, array()); 

                    if ($subcount > 0) {
                        $count += $subcount;
                        $feed = array_merge($feed, $subfeed);
                    }    
                }

                if (!empty(\Idno\Core\Idno::site()->config()->description)) {
                    $description = \Idno\Core\Idno::site()->config()->description;
                } else {
                    $description = 'An independent social website, powered by Known.';
                }
                $description = $description . ": On This Day";

                // If we have a feed, set our last modified flag to the time of the latest returned entry
                if (!empty($feed)) {
                    if (is_array($feed)) {
                        $feed = array_filter($feed);
                        $this->setLastModifiedHeader(reset($feed)->updated);
                    }
                }

                if (!empty(\Idno\Core\Idno::site()->config()->homepagetitle)) {
                    $title = \Idno\Core\Idno::site()->config()->homepagetitle;
                } else {
                    $title = \Idno\Core\Idno::site()->config()->title;
                }
                $title = $title . ": On This Day";

                $t = \Idno\Core\Idno::site()->template();
                $t->__(array(

                    'title'       => $title,
                    'description' => $description,
                    'content'     => $friendly_types,
                    'body'        => $t->__(array(
                        'items'        => $feed,
                        'contentTypes' => array(),
                        'count'        => $count,
                        'subject'      => $query,
                        'date'         => $start,
                        'content'      => $friendly_types
                    ))->draw('pages/onthisday'),

                ))->drawPage();
            }

        }

    }
