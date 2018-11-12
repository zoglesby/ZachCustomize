<?php
    /**
     * Requires https://github.com/indieweb/representative-h-card-php
     */

    namespace IdnoPlugins\CleverCustomize\Pages {
        
        require_once('representative-h-card.php');
        
        class Nicknames extends \Idno\Common\Page 
        {
            function get()
            {
                header('Content-Type: application/json');
                
                if ($url = trim($this->getInput('url'))) {
                    if ($content = \Idno\Core\Webservice::get($url)['content']) {
                        $parser = new \Mf2\Parser($content, $url);
                        
                        if ($parsed = $parser->parse()) {
                            // debug
                            if ($this->getInput('debug')) {
                                echo json_encode($parsed);
                                return;
                            }
                            
                            // find the person's name
                            $representative = \Mf2\HCard\representative($parsed, $url);
                            $nickname = $representative['properties']['name'][0];
                            
                            // map rel=me links to mention targets
                            if (isset($parsed['rels'])) {
                                $output = array();
                                foreach (array_unique($parsed['rels']['me']) as $relme) {
                                    if ($mapping = $this->urlToMetadata($relme, $nickname)) {
                                        $output[] = $mapping;
                                    }
                                }
                                echo json_encode($output);
                            }
                        } else {
                            echo json_encode("Failed to parse...");
                        }
                    } else {
                        echo json_encode("Failed to fetch site...");
                        $response = \Idno\Core\Webservice::get($url);
                        echo json_encode($response);
                    }
                }
            }

            private function urlToMetadata($url, $nickname)
            {
                $matches = array();

                /* Twitter */
                if (preg_match("/^https?\:\/\/(www\.)?twitter.com\/([\S]+\.?)/i", $url, $matches)) {
                    $username = str_replace("/", "", $matches[count($matches)-1]);
                    if (!$nickname) $nickname = '@' . $username; 
                    return [
                        "type" => "twitter",
                        "username" => $username,
                        "url" => $url,
                        "mention" => [
                            "html" => '<a href="https://twitter.com/' . $username . '">' . $nickname . '</a>',
                            "text" => '@' . $username
                        ]
                    ];
                } else if (preg_match("/^https?\:\/\/(www\.)?instagram.com\/([\S]+\.?)/i", $url, $matches)) {
                    $username = str_replace("/", "", $matches[count($matches)-1]);
                    if (!$nickname) $nickname = '@' . $username; 
                    return [
                        "type" => "instagram",
                        "username" => $username,
                        "url" => $url,
                        "mention" => [
                            "html" => '<a href="https://instagram.com/' . $username . '">' . $nickname . '</a>',
                            "text" => '@' . $username
                        ]
                    ];
                } else if (preg_match("/^https?\:\/\/(www\.)?micro.blog\/([\S]+\.?)/i", $url, $matches)) {
                    $username = str_replace("/", "", $matches[count($matches)-1]);
                    if (!$nickname) $nickname = '@' . $username; 
                    return [
                        "type" => "micro.blog",
                        "username" => $username,
                        "url" => $url,
                        "mention" => [
                            "html" => '<a href="https://micro.blog/' . $username . '">' . $nickname . '</a>',
                            "text" => '@' . $username
                        ]
                    ];
                } else if (preg_match("/^https?\:\/\/(www\.)?linkedin.com\/in\/([\S]+\.?)/i", $url, $matches)) {
                    $username = str_replace("/", "", $matches[count($matches)-1]);
                    if (!$nickname) $nickname = '@' . $username;
                    return [
                        "type" => "linkedin",
                        "username" => $username, 
                        "url" => $url,
                        "mention" => [
                            "html" => '<a href="https://www.linkedin.com/in/' . $username . '">' . $nickname . '</a>',
                            "text" => '@' . $username
                        ]
                    ];
                } else if (preg_match("/^https?\:\/\/(www\.)?github.com\/([\S]+\.?)/i", $url, $matches)) {
                    $username = str_replace("/", "", $matches[count($matches)-1]);
                    if (!$nickname) $nickname = '@' . $username; 
                    return [
                        "type" => "github",
                        "username" => $username,
                        "url" => $url,
                        "mention" => [
                            "html" => '<a href="https://github.com/' . $username . '">' . $nickname . '</a>',
                            "text" => '@' . $username
                        ]
                    ];
                } else if (preg_match("/^https?\:\/\/(www\.)?keybase.io\/([\S]+\.?)/i", $url, $matches)) {
                    $username = str_replace("/", "", $matches[count($matches)-1]);
                    if (!$nickname) $nickname = '@' . $username; 
                    return [
                        "type" => "keybase",
                        "username" => $username,
                        "url" => $url,
                        "mention" => [
                            "html" => '<a href="https://keybase.io/' . $username . '">' . $nickname . '</a>',
                            "text" => '@' . $username
                        ]
                    ];
                }

            }

            private function findName(array $mf2)
            {
                foreach ($mf2 as $item) {
                    // Find h-card
                    if (in_array('h-card', $item['type'])) {
                        return $item['properties']['name'][0];
                    }
                }
            }

        }

    }
?>
