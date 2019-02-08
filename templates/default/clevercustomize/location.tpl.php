<?php

    $object = $vars['object'];
    $location_meta = $object->getAnnotations('location-metadata');
    if (!empty($location_meta)) {
        $location_meta = array_pop(array_pop($location_meta));

        if ($object->getActivityStreamsObjectType() != 'place') {
?>
        <div id="location-annotation" style="margin: 1em 0 2em 0">
            <b>Jonathan's Location at Posting</b> <small>(click the marker to see more)</small>
            <div id="location-annotation-map-<?= $object->_id ?>" style="width: 100%; height: 250px; border: 1px solid #666"></div>
            <script>
            var map = L.map('location-annotation-map-<?= $object->_id ?>', {
                touchZoom: false,
                scrollWheelZoom: false
            }).setView([<?= $location_meta['y'] ?>, <?= $location_meta['x'] ?>], 16);
            var layer = new L.StamenTileLayer('toner-lite');
            map.addLayer(layer);
            
            var group = new L.featureGroup();
            var marker = L.marker([<?= $location_meta['y'] ?>, <?= $location_meta['x'] ?>], {
                title: "Jonathan's location at time of posting"
            });
            marker.addTo(map);
            group.addLayer(marker);
            marker.bindPopup(
                "<b style=\"font-size: 14px\">At time of posting:</b><br>" + 
                "<ul style=\"list-style-type: none; margin: 1em 0 0 0; padding-left: 0.25em\">" +
                "  <li>⛰️ <?= $location_meta['altitude'] ?> meters elevation</li>" +
                "  <li>🔍 <?= $location_meta['motion'][0] ?></li>" + 
                "  <li>💨 <?= max($location_meta['speed'], 0) ?> mph</li>" +
                "  <li>🔋 <?= round($location_meta['battery_level'] * 100, 0) ?>% charged, <?= $location_meta['battery_state'] ?></li>" +
                "  <li>📶 <?= empty($location_meta['wifi']) ? 'cellular' : 'wifi' ?> connection</li>" +
                "</ul>"
            );
            
            map.scrollWheelZoom.disable();
            map.touchZoom.disable();
            map.doubleClickZoom.disable()
            </script>
        </div>
<?php
        }
    }
?>
