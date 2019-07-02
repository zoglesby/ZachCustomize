<!DOCTYPE html>
<script src="https://cdn.apple-mapkit.com/mk/5.x.x/mapkit.js"></script>

<div class="row page-now">
    <div class="col-md-10 col-md-offset-1">
        <div>
            <div class="row">
                
                <ul id="current-status-now">
                <?php
                    $battery_icon = "fa-battery-full";
                    if ($status['battery_level'] <= 0.75) {
                        $battery_icon = "fa-battery-three-quarters";
                    }
                    if ($status['battery_level'] <= 0.5) {
                        $battery_icon = "fa-battery-half";
                    }
                    if ($status['battery_level'] <= 0.25) {
                        $battery_icon = "fa-battery-quarter";
                    }
                    if ($status['battery_level'] <= 0.05) {
                        $battery_icon = "fa-battery-empty";
                    }

                    $wifi_state = "wifi-disconnected";
                    if (strlen($status['wifi']) > 0) {
                        $wifi_state = "wifi-connected";
                    }
                    
                    $motion_icon = "fa-male"; // stationary
                    foreach ($status['motion'] as $value) {
                        if ($value == "driving") {
                            $motion_icon = "fa-car";
                        } else if ($value == "walking") {
                            $motion_icon = "fa-street-view";
                        } else if ($value == "running") {
                            $motion_icon = "fa-street-view";
                        } else if ($value == "cycling") {
                            $motion_icon = "fa-bicycle";
                        }
                    }
                ?>
                    <li id="battery"><i class="fa <?= $battery_icon ?> <?= $status['battery_state'] ?>"></i></li>
                    <li id="wifi"><i class="fa fa-wifi <?= $wifi_state ?>"></i></li>
                    <li id="motion"><i class="fa <?= $motion_icon ?>"></i></li>
                </ul>

                <div id="map"></div>

                <script>
                mapkit.init({
                    authorizationCallback: function(done) {
                        done('eyJhbGciOiJFUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6IkIyRFRBVkEyVFgifQ.eyJpc3MiOiJGSlBINjNBTU5ZIiwiaWF0IjoxNTYyMDgxNjEyLCJleHAiOjE1OTY5MDA4MTIsIm9yaWdpbiI6Imh0dHBzOi8vemFjaC5vZ2xlc2J5LmNvIn0.xZPyNvgnHkbaiQIonaD0SEeoOK-5E-mbbYtBOUe-xLnlDH3XHd764bKcZ7I2pClQ_8uBWGbbhhZ3WWZya7Ok9w');
                    }
                });

                var currentLocation = new mapkit.Coordinate(<?= $status['y'] ?>, <?= $status['x'] ?>);
                var region = new mapkit.CoordinateRegion(
                    currentLocation, 
                    new mapkit.CoordinateSpan(0.167647972, 0.354985255)
                );
                var meAnnotation = new mapkit.MarkerAnnotation(currentLocation, { title: "Zach", glyphText: "🤖" });

                var map = new mapkit.Map("map", {
                    'mapType': mapkit.Map.MapTypes.Hybrid
                });
                map.showItems([meAnnotation]);
                map.region = region;
                </script>
            </div>
        </div>
    </div>
</div>
