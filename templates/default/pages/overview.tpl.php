<script type="text/javascript">
    function toggle(to) {
        $('.picker-microblog').toggleClass('active');
        $('.picker-articles').toggleClass('active');
        $('.overview-microblog').toggle();
        $('.overview-articles').toggle();
    }
</script>

<div class="overview">
    <div class="col-md-20 col-md-offset-0">
    
    <!-- content -->
    <div class="overview-content">
        <ul class="picker">
            <li class="picker-microblog active">
                <a href="#" onclick="toggle('microblog'); return false;">
                    <h2><i class="fa fa-comment"></i>Microblog</h2>
                </a>
            </li>
            <li class="picker-articles">
                <a href="#" onclick="toggle('articles'); return false;">
                    <h2><i class="fa fa-file"></i>Articles</h2>
                </a>
            </li>
        </ul>        

        <div class="overview-articles" style="display: none">
            <?php
            $count = 0;
            foreach ($posts as $post) {
                if (++$count == 11) break;
            ?>
                
                <div class="idno-object idno-content"> 
                <div class="row idno-entry">
                    <?= $post->draw() ?>
                </div>
                </div>
            <?php
            }
            ?>
        </div>
        
        <!-- microblog -->
        <div class="overview-microblog">
            <?php
            foreach ($statuses as $status) {
            ?>
                <div class="status">
                    <?php
                    if (!empty($status->inreplyto)) {
                    ?>
                    <div class="reply">
                        <i class="fa fa-reply"></i>
                        <?php
                        if (is_array($status->inreplyto)) {
                        ?>
                        <a href="<?= $status->inreplyto[0] ?>"><?= $status->inreplyto[0] ?></a>
                        <?php
                        } else {
                        ?>
                        <a href="<?= $status->inreplyto ?>"><?= $status->inreplyto ?></a>
                        <?php
                        }
                        ?> 
                    </div>
                    <?php
                    }
                    ?>
                    <div class="content"><?= $icon ?><?= $status->getBody() ?></div>
                    <a class="u-url url" href="<?= $status->getURL() ?>">
                        <time class="dt-published" datetime="<?= date(DATE_ISO8601, $status->created) ?>"><?= strftime('%d %b %Y', $status->created) ?></time> 
                    </a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <!-- photos -->
    <div class="overview-photos">
        <h2>
            <i class="fa fa-camera-retro"></i>Photos 
            <a href="/photos" target="_blank" style="float: right">
                <i class="fa fa-external-link-alt"></i>
            </a>
        </h2>
        <?php
        $count = 0;
        foreach ($photos as $photo) {
            $thumbs = [];
            if ($photo['thumbnail_small'] != null) {
                array_push($thumbs, $photo['thumbnail_small']);
            } else if ($photo['thumbs_small'] != null) {
                foreach ($photo['thumbs_small'] as $thumb) {
                    array_push($thumbs, $thumb['url']);
                }
            } else {
                continue;
            }

            foreach ($thumbs as $thumb) {
                if (++$count >= 25) break;
        ?>
                <a href="<?= $photo->getURL() ?>">
                    <div class="photo" style="background-image:url(<?= $thumb ?>); background-size: cover; background-position: 50%"></div>
                </a>
        <?php
            }
        }
        ?>
    </div>

    <!-- interactions -->
    <div class="overview-interactions">
        <h2><i class="fa fa-comments"></i>Interactions</h2>
    <?php
    foreach ($interactions as $interaction) {
        $class = '';
        $icon = '';
        $link = $interaction->body;

        if (!empty($interaction->targetURL)) {
            $icon = '<i class="fab fa-github"></i>';
            $link = $interaction->targetURL;
        } elseif (!empty($interaction->likeof)) {
            $class = 'u-like-of';
            $icon = '<i class="fa fa-thumbs-up"></i>';
        } elseif (!empty($interaction->repostof)) {
            $class = 'u-repost-of';
            $icon = '<i class="fa fa-retweet"></i>';
        } else {
            $class = 'u-bookmark-of';
            $icon = '<i class="fa fa-bookmark"></i>';
        }

        $body = $interaction->body;
        if (!empty($interaction->pageTitle)) {
            $body = $interaction->pageTitle;
        } elseif (!empty($interaction->title)) {
            $body = $interaction->title;
        }
    ?>
        <div class="interaction">
            <?= $icon ?>
            <a href="<?= $link ?>" class="<?= $class ?> p-name" target="_blank">
                <?= htmlentities(strip_tags($body)) ?>
            </a>
        </div>
    <?php
    }
    ?>
    </div>

    <!-- watched -->
    <div class="overview-watched">
        <h2><i class="fa fa-film"></i>Watched</h2>
        <?php
        foreach ($watched as $watch) {
            $poster = '';
            if ($attachments = $watch->getAttachments()) {
                foreach ($attachments as $attachment) {
                    $poster = '<img src="' . $attachment['url'] . '" class="poster">';
                    break;
                }
            }
        ?>
            <div class="watched">
                <a href="<?= $watch->getURL() ?>">
                    <?= $poster ?>
                </a>
            </div>
        <?php
        }
        ?>
    </div>

    <!-- checkins -->
    <div class="overview-checkins">
        <h2><i class="fa fa-map-pin"></i>Places</h2>
        <?php
        foreach ($checkins as $checkin) {
        ?>
            <div class="checkin">
                <a href="<?= $checkin->getURL() ?>">
                    <?= $checkin->placename ?>
                </a>
            </div>
        <?php
        }
        ?>
    </div>

    
</div>
