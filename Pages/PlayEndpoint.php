<?php

    namespace IdnoPlugins\CleverCustomize\Pages {
        
        class PlayEndpoint extends \Idno\Common\Page 
        {
            
            function post()
            {
                $this->setResponse(500);
                \Idno\Core\Idno::site()->triggerEvent('play/post/start', ['page' => $this]);
                $this->postCreate();
            }

            function postCreate()
            {
                $payload = $this->getInput('payload');
                $json = json_decode($payload);
                
                $this->setInput('title', $json->title);
                $this->setInput('body', $json->summary);
                $this->setInput('duration', $json->duration);
                $this->setInput('gameURL', $json->gameURL);
                $this->setInput('created', $json->publishDateTime);

                $contentType = new \IdnoPlugins\Play\ContentType();
                
                $entity = $contentType->createEntity();
                $entity->setOwner('http://zach.oglesby.co/profile/zach');
                $result = $entity->saveDataFromInput();
                $entity->publish();
                
                if ($result) {
                    \Idno\Core\Idno::site()->triggerEvent('play/post/success', ['page' => $this, 'object' => $entity]);
                    $this->setResponse(201);
                    header('Location: ' . $entity->getURL());
                    exit();
                } else {
                    $this->setResponse(500);
                    exit();
                } 
            }

        }

    }
?>
