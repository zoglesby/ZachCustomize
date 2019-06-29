<!DOCTYPE html>
<script src="https://cdn.apple-mapkit.com/mk/5.x.x/mapkit.js"></script>

<div class="row page-now">
    <div class="col-md-10 col-md-offset-1">
        <div>
            <div class="row">
                <div style="text-align: center">
                    <a target="_blank" href="https://trakt.tv/users/cleverdevil"><img width="500" height="40" alt="cleverdevil" src="https://widgets.trakt.tv/users/8f26448c4265bd6077447ba88d84cc75/watched/thin@2x.jpg" style="margin: 0 auto 2em auto"/></a>                
                </div>

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
                        done('eyJ0eXAiOiJKV1QiLCJhbGciOiJFUzI1NiIsImtpZCI6IkQzNVJIWVVVMjcifQ.eyJvcmlnaW4iOiJodHRwczovL2NsZXZlcmRldmlsLmlvIiwiaXNzIjoiN1Y2VzUyNTY2MyIsImlhdCI6MTU2MTE3MDY0NiwiZXhwIjoxODc2NTMwNjQ2fQ.pI7T85udg8OKg-4QaLeFyJLqO7_caiy_VDDZjntgUyeL_izSDEudsS9xCGOeKwjoKTalc4pzOoHk80e8AN6Qrg');
                    }
                });

                var currentLocation = new mapkit.Coordinate(<?= $status['y'] ?>, <?= $status['x'] ?>);
                var region = new mapkit.CoordinateRegion(
                    currentLocation, 
                    new mapkit.CoordinateSpan(0.167647972, 0.354985255)
                );
                var meAnnotation = new mapkit.MarkerAnnotation(currentLocation, { title: "cleverdevil", glyphText: "😈" });

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
