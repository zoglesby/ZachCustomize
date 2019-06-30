<?php

    namespace IdnoPlugins\CleverCustomize\Pages {
        
        use Idno\Entities\User;
        use Idno\Core\Webservice;

        class Following extends \Idno\Common\Page
        {

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
                
                // set descriptions
                if (!empty(\Idno\Core\Idno::site()->config()->description)) {
                    $description = \Idno\Core\Idno::site()->config()->description;
                } else {
                    $description = 'An independent social website, powered by Known.';
                }
                $description = $description . ': Following'; 
                $title = $description;

                // pull configuration 
                $token = \Idno\Core\Idno::site()->config()->microsub_token;
                $endpoint = \Idno\Core\Idno::site()->config()->microsub_endpoint;
                $blacklist = explode(' ', \Idno\Core\Idno::site()->config()->microsub_blacklist);
                $headers = array(
                    'Authorization: Bearer ' . $token
                );

                // fetch the channels from the microsub server
                $response = Webservice::get($endpoint, array(
                    'action' => 'channels'
                ), $headers);

                if ($response['response'] != 200) {
                    // handle errors
                }
                
                $all_channels = json_decode($response['content'])->channels;
                $channels = array();
                foreach ($all_channels as $item) {
                    if (in_array($item->uid, $blacklist)) {
                        continue;
                    }
                    
                    // fetch the feeds for the channel
                    $response = Webservice::get($endpoint, array(
                        'action' => 'follow',
                        'channel' => $item->uid
                    ), $headers);

                    if ($response['response'] != 200) {
                        continue;
                    }
                    
                    $channel = array();
                    $channel['name'] = $item->name;
                    $channel['feeds'] = json_decode($response['content'])->items;

                    array_push($channels, $channel);
                }
                
                
                $t = \Idno\Core\Idno::site()->template();
                $t->__(array(
                    'title'        => $title,
                    'description'  => $description,
                    'content'      => array('all'),
                    'body'         => $t->__(array(
                        'channels'    => $channels
                    ))->draw('pages/following'),
                ))->drawPage();
            }

        }

    }
