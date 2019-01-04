<style type="text/css">
    #summary h1 {
        font-size: 3.0em !important;
        margin: 1em 0 0.75em 0;
    }

    #summary h2 {
        font-size: 1.75em !important;
        margin: 1em 0 0.75em 0;
    }

    #summary {
        background: white;
        padding: 2em 3em 4em 3em;
        overflow: hidden;
        text-align: center;
    }
    
    #summary-container {
        text-align: left;
        margin: 0 auto;
    }

    @media (min-width: 992px) {
        #summary {
            margin-left: 1em;
        }
    }

    #summary section {
        margin: 1em 0 0 0;
        clear: both;
    }

    #content-types {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }

    #content-types li {
        float: left;
        padding: 0.5em 1em;
        margin: 0 1em 1em 0;
        background: #ddd;
    }
    
    #posts ul, #recipes ul, #rsvps ul, #reviews ul {
        padding: 0 0 0 1em;
    }    

    #photos {
        overflow: hidden;
        clear: both;
    }
    #photos .photo {
        float: left;
        margin: 0 1em 1em 0;
        width: 100px;
        height: 100px; 
    }
    
    #photos .photo:hover {
        cursor: pointer;
        opacity: 0.75;
    }


    #map {
        height: 400px;
    }
    
    #watching {
        overflow: hidden;
    }
    #watching .watched {
        float: left;
        margin: 0 1em 1em 0;
        width: 100px;
        height: 150px;
    }

    
    #interactions .interaction {
        width: 98%;
        height: 2em;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    
    #statuses .status {
        background: #eee;
        margin: 0.5em 0;
        padding: 0.5em 1em;
    }
</style>


<div id="summary">
<div id="summary-container" class="col-md-20 col-md-offset-0">

<h1><i class="fa fa-feather"></i>Summary for <?= $description ?></h1>

<p>In <?= $description ?>, <a href="/archive/<?= $year ?>/<?= $month ?>">Jonathan posted <?= $count ?> times</a>.</p>

<ul id="content-types">
<?php
foreach (array_keys($entities) as $category) {
?>
    <li>
        <?= $typemap[$category] ?>
        <?= count($entities[$category]) ?> <?= ($category == "Photos") ? "Photo albums" : $category ?>
    </li>
<?php
}    
?>
</ul>


<!-- posts -->
<?php
if (array_key_exists("Posts", $entities)) {
?>
<section id="posts">
    <h2><?= $typemap["Posts"] ?>Posts</h2>
    <ul>
<?php
    foreach ($entities["Posts"] as $post) {
?>
        <li><a href="<?= $post->getURL() ?>"><?= htmlentities(strip_tags($post->getTitle())) ?></a></li>
<?php
    }
?>
    </ul>
</section>
<?php
}
?>


<!-- reviews -->
<?php
if (array_key_exists("Reviews", $entities)) {
?>
<section id="reviews">
    <h2><?= $typemap["Reviews"] ?>Reviews</h2>
    <ul>
<?php
    foreach ($entities["Reviews"] as $post) {
?>
        <li>
            <a href="<?= $post->getURL() ?>">
                <?= htmlentities(strip_tags($post->getTitle())) ?>
                - <?php
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $post->getRating()) {
                        echo '<i class="fas fa-star"></i>';
                    } else {
                        echo '<i class="far fa-star"></i>';
                    }
                }
                ?>
            </a>
        </li>
<?php
    }
?>
    </ul>
</section>
<?php
}
?>


<!-- recipes -->
<?php
if (array_key_exists("Recipes", $entities)) {
?>
<section id="recipes">
    <h2><?= $typemap["Recipes"] ?>Recipes</h2>
    <ul>
<?php
    foreach ($entities["Recipes"] as $post) {
?>
        <li><a href="<?= $post->getURL() ?>"><?= htmlentities(strip_tags($post->getTitle())) ?></a></li>
<?php
    }
?>
    </ul>
</section>
<?php
}
?>


<!-- rsvps -->
<?php
if (array_key_exists("RSVP", $entities)) {
?>
<section id="rsvps">
    <h2><?= $typemap["RSVP"] ?>RSVPs</h2>
    <ul>
<?php
    foreach ($entities["RSVP"] as $post) {
?>
        <li><a href="<?= $post->getURL() ?>"><?= htmlentities(strip_tags($post->getTitle())) ?></a></li>
<?php
    }
?>
    </ul>
</section>
<?php
}
?>


<!-- photos -->
<?php
if (array_key_exists("Photos", $entities)) {
?>    
<section id="photos">
    <h2><?= $typemap["Photos"] ?>Photos</h2>
<?php 
   foreach ($entities["Photos"] as $photo) {
        $thumbs = [];
        if ($photo['thumbnail_large'] != null) {
            array_push($thumbs, $photo['thumbnail_large']);
        } else if ($photo['thumbs_large'] != null) {
            foreach ($photo['thumbs_large'] as $thumb) {
                array_push($thumbs, $thumb['url']);
            }
        } else {
            continue;
        }

        foreach ($thumbs as $thumb) {
?>
            <a href="<?= $photo->getURL() ?>">
            <div class="photo" style="background-image: url(<?= $thumb ?>); background-size: cover; background-position: 50%"></div>
            </a>
<?php
        }
    }
}
?>
</section>

<!-- checkins -->
<?php
if (array_key_exists("Locations", $entities)) {
?>
<section id="locations">
    <h2><?= $typemap["Locations"] ?>Checkins</h2>
    <div id="map"></div>
    
    <script>
    var map = L.map('map', {
        touchZoom: false,
        scroolWheelZoom: false
    }).setView([0, 0], 16);
    var layer = new L.StamenTileLayer('toner-lite');
    map.addLayer(layer);

    var group = new L.featureGroup();

    <?php
    foreach ($entities["Locations"] as $location) {
    ?>
        var marker<?php echo $location->_id?> = L.marker([<?php echo $location->lat?>, <?php echo $location->long?>], {
            title: "<?php echo $location->placename ?>"
        });
        marker<?php echo $location->_id?>.addTo(map);
        group.addLayer(marker<?php echo $location->_id?>);
        marker<?php echo $location->_id?>.bindPopup(
            "<b>" + <?php echo json_encode(htmlspecialchars($location->getTitle()))?> + "</b><br><a href=\"<?php echo $location->getURL()?>\"><?php echo date('F j, Y', $location->created)?></a>"
        );
    <?php
    }
    ?>
    map.fitBounds(group.getBounds());
    map.scrollWheelZoom.disable();
    map.touchZoom.disable();
    map.doubleClickZoom.disable();
    </script>
</section>
<?php
}
?>



<!-- watched -->
<?php
if (array_key_exists("Watching", $entities)) {
?>
<section id="watching">
    <h2><?= $typemap["Watching"] ?>Watched</h2>
    <?php
    foreach ($entities["Watching"] as $watch) {
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
</section>
<?php
}
?>



<!-- status updates -->
<?php
if (array_key_exists("Status updates", $entities)) {
?>
<section id="statuses">
    <h2><?= $typemap["Status updates"] ?>Microblog</h2>
    
    <details>
        <summary><?= count($entities["Status updates"]) ?> updates</summary>
        <?php
        foreach ($entities["Status updates"] as $status) {
        ?>
        <div class="status">
            <?php
            if (!empty($status->inreplyto)) {
            ?>
            <div>
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
            <div><?= $icon ?><?= $status->getBody() ?></div>
            <a href="<?= $status->getURL() ?>">
                <time datetime="<?= date(DATE_ISO8601, $status->created) ?>"><?= strftime('%d %b %Y', $status->created) ?></time>
            </a>
        </div>
        <?php
        }
        ?>
    </details>
<?php
}
?>
</section>


<!-- bookmarks -->
<?php
if (array_key_exists("Bookmarked pages", $entities)) {
?>
<section id="interactions">
    <h2><i class="fa fa-comments"></i>Interactions</h2>
    <details>
        <summary><?= count($entities["Bookmarked pages"]) ?> likes, reposts, and bookmarks</summary>
        <?php
        foreach ($entities["Bookmarked pages"] as $interaction) {
            $icon = '';
            $link = $interaction->body;

            if (!empty($interaction->targetURL)) {
                $icon = '<i class="fab fa-github"></i>';
                $link = $interaction->targetURL;
            } elseif (!empty($interaction->likeof)) {
                $icon = '<i class="fa fa-thumbs-up"></i>';
            } elseif (!empty($interaction->repostof)) {
                $icon = '<i class="fa fa-retweet"></i>';
            } else {
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
                <a href="<?= $link ?>" target="_blank">
                    <?= htmlentities(strip_tags($body)) ?>
                </a>
            </div>
        <?php
        }
        ?>
    </details>
</section>
<?php
}
?>


</div>
</div>
