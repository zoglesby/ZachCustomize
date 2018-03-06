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
        class ArchiveIndex extends \Idno\Common\Page
        {

            // Handle GET requests to the homepage

            function getContent()
            {
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


                if (!empty(\Idno\Core\Idno::site()->config()->description)) {
                    $description = \Idno\Core\Idno::site()->config()->description;
                } else {
                    $description = 'An independent social website, powered by Known.';
                }
                $description = $description . ': History'; 
                $title = $description;

                $query = "select distinct date(created) from entities";

                $db = \Idno\Core\Idno::site()->db->getClient();
                $statement = $db->prepare($query);
                $statement->execute();
                $rows = $statement->fetchAll(\PDO::FETCH_ASSOC);
                $dates = [];
                foreach ($rows as $row) {
                    $dates[] = $row['date(created)'];
                }


                $t = \Idno\Core\Idno::site()->template();
                $t->__(array(
                    'title'       => $title,
                    'description' => $description,
                    'content'     => array('all'),
                    'body'        => $t->__(array(
                        'dates'   => $dates
                    ))->draw('pages/archiveindex'),

                ))->drawPage();
            }

        }

    }
