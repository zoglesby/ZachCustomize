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
        class Archive extends \Idno\Common\Page
        {

            // Handle GET requests to the homepage

            function getContent()
            {
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
                $search['publish_status'] = 'published';

                /* identify target date range */
                $year = date('Y');
                $month = '01';
                $day = null;
                $start = null;
                $end = null;
                $range = '';
                if (count($this->arguments) == 2) {
                    $year = $this->arguments[0];
                    $month = $this->arguments[1];

                    $start = strtotime($year . '-' . $month . '-01');
                    $end = strtotime($year . '-' . $month . ' +1 month');

                    $range = date('F, Y', $start);
                } else if (count($this->arguments) == 3) {
                    $year = $this->arguments[0];
                    $month = $this->arguments[1];
                    $day = $this->arguments[2];

                    $start = strtotime($year . '-' . $month . '-' . $day);
                    $end = strtotime($year . '-' . $month . '-' . $day . ' +1 day');
                    
                    $range = date('F d, Y', $start);
                }

                $count = 0;
                $feed = array();
                
                $search['created']['$gt'] = date('Y-m-d 00:00:00', $start);
                $search['created']['$lt'] = date('Y-m-d 00:00:00', $end);  
                    
                $count = \Idno\Common\Entity::countFromX($types, $search, array(), PHP_INT_MAX-1);
                $feed = \Idno\Common\Entity::getFromX($types, $search, array(), PHP_INT_MAX-1); 
                $feed = array_reverse($feed); 

                $description = "History for " . $range;
                
                // If we have a feed, set our last modified flag to the time of the latest returned entry
                if (!empty($feed)) {
                    if (is_array($feed)) {
                        $feed = array_filter($feed);
                        $this->setLastModifiedHeader(reset($feed)->updated);
                    }
                }

                $t = \Idno\Core\Idno::site()->template();
                $t->__(array(

                    'title'       => $description,
                    'description' => $description,
                    'content'     => $friendly_types,
                    'body'        => $t->__(array(
                        'items'        => $feed,
                        'contentTypes' => array(),
                        'count'        => $count,
                        'subject'      => $query,
                        'date'         => $start,
                        'description'  => $range,
                        'content'      => $friendly_types
                    ))->draw('pages/archive'),

                ))->drawPage();
            }

        }

    }
