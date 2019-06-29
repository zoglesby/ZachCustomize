    <!DOCTYPE html>
    <script src="https://cdn.apple-mapkit.com/mk/5.x.x/mapkit.js"></script>

    <div class="row page-map">
        <div class="col-md-10 col-md-offset-1">
            <div>
                <div class="row">
                    
                <div id="map-nav">
                    <a class="left" href="/map?date=<?= date('Y-m-d', strtotime($date . ' -1 day')) ?>"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a>
                    <a class="right" href="/map?date=<?= date('Y-m-d', strtotime($date . ' +1 day')) ?>"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
                    <h1><i class="fa fa-calendar"></i><?= date('F j, Y', strtotime($date)) ?></h1>
                </div>
                <div id="map"></div>             
                <script>
                mapkit.init({
                    authorizationCallback: function(done) {
                        done('eyJ0eXAiOiJKV1QiLCJhbGciOiJFUzI1NiIsImtpZCI6IkQzNVJIWVVVMjcifQ.eyJvcmlnaW4iOiJodHRwczovL2NsZXZlcmRldmlsLmlvIiwiaXNzIjoiN1Y2VzUyNTY2MyIsImlhdCI6MTU2MTE3MDY0NiwiZXhwIjoxODc2NTMwNjQ2fQ.pI7T85udg8OKg-4QaLeFyJLqO7_caiy_VDDZjntgUyeL_izSDEudsS9xCGOeKwjoKTalc4pzOoHk80e8AN6Qrg');
                    }
                });
                var map = new mapkit.Map("map");
                var coordinates = [];
                var annotations = [];

                function calloutForPointAnnotation(annotation) {
                    var div = document.createElement("div");
                    div.className = "point";

                    var title = div.appendChild(document.createElement("h1"));
                    title.textContent = new Date(annotation.point.timestamp).toLocaleString();
                    
                    var section = div.appendChild(document.createElement("section"));

                    var battery = section.appendChild(document.createElement("p"));
                    battery.className = "battery";
                    battery.textContent = '🔋 ' + (annotation.point.battery_level * 100).toFixed(2) + '%, ' + annotation.point.battery_state;
                    
                    var motion = section.appendChild(document.createElement("p"));
                    motion.className = "motion";
                    if (annotation.point.motion.search('walking') != -1) {
                        motion.textContent = '🚶🏻‍♂️ ' + annotation.point.speed + ' mph';
                    } else if (annotation.point.motion.search('running') != -1) {
                        motion.textContent = '🏃🏻‍♂️ ' + annotation.point.speed + ' mph';
                    } else if (annotation.point.motion.search('driving') != -1) {
                        motion.textContent = '🚗 ' + annotation.point.speed + ' mph';
                    } else if (annotation.point.motion.search('cycling') != -1) {
                        motion.textContent = '🚴🏻‍♂️ ' + annotation.point.speed + ' mph';
                    } else { 
                        motion.textContent = '🛋';
                    }

                    var altitude = section.appendChild(document.createElement("p"));
                    altitude.className = "altitude";
                    altitude.textContent = '⛰ ' + annotation.point.altitude + ' meters';

                    var connection = section.appendChild(document.createElement("p"));
                    connection.className = "connection";
                    if (annotation.point.wifi) {
                        connection.textContent = '📶 (Wi-Fi: ' + annotation.point.wifi + ')';
                    } else {
                        connection.textContent = '📶 (Cellular)';
                    }

                    return div;
                }
                var CALLOUT_OFFSET = new DOMPoint(-148, -150);
                var pointAnnotationCallout = {
                    calloutElementForAnnotation: function(annotation) {
                        return calloutForPointAnnotation(annotation);
                    },
                    calloutAnchorOffsetForAnnotation: function(annotation, element) {
                        return CALLOUT_OFFSET;
                    },
                    calloutAppearanceAnimationForAnnotation: function(annotation) {
                        return "scale-and-fadein .4s 0 1 normal cubic-bezier(0.4, 0, 0, 1.5)";
                    }
                };

                var points = <?= $points ?>; 
                for (var i = 0; i < points.length; i++) {
                    var point = points[i];
                    var coordinate = new mapkit.Coordinate(
                        point['y'], 
                        point['x']
                    );
                    coordinates.push(coordinate);
                    
                    if ((i % 20) == 0) {
                        var annotation = new mapkit.MarkerAnnotation(coordinate, {
                            callout: pointAnnotationCallout
                        });
                        annotation.point = point;
                        annotations.push(annotation);
                    }
                }
                
                var style = new mapkit.Style({
                    lineWidth: 2,
                    lineJoin: "round",
                    lineDash: [8, 4],
                    strokeColor: "#F0F"
                });
                var polyline = new mapkit.PolylineOverlay(coordinates, { style: style });

                map.showItems(annotations);
                map.addOverlay(polyline);
                </script>
            </div>
        </div>
    </div>
</div>
