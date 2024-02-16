$(document).ready(function () {
    $('body').on('change', '#floating_check', function (event) {
        event.preventDefault();
        var request_id = 8799
        var
            column_name = $(this).attr('name');
        if ($(this).is(':checked')) {
            check = 1;
        } else {
            check = 0;
        }
        var url = 'https://opvs.propsure.co/checklist-update';
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: url,
            method: 'post',
            data: {
                _token: CSRF_TOKEN,
                request_id: request_id,
                check: check,
                column_name: column_name
            },
            success: function (data) {
                console.log(data)
                if (data == 1) {
                    Swal.fire({
                        position: 'top-end',
                        width: 300,
                        icon: 'success',
                        title: 'Updated Successfully',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    window.location.reload();
                }
            }
        });
    });

    $('#form_submit').click(function () {

        if ($("#user_comment").val().length != 0) {

            if ($('#request_status').val() == 'Completed') {

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-bottom-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": 300,
                    "hideDuration": 1000,
                    "timeOut": 5000,
                    "extendedTimeOut": 1000,
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr["success"]("Email sending to the user and PDF file are generationg, be patient");


            }

            $("#modal_form").submit();
        } else {
            document.getElementById("comment_error").innerHTML = "Comment field is required"
        }
    });


    let map = "";
    var states_polygons = "";
    let center = []

    map = L.map('map').setView([30.85, 70.11], 5);
    let counties = {},
        countiesPolygons;
    // L.tileLayer('https://api.mapbox.com/styles/v1/araza410/ckum8p5yx0t9l17m08yt02x6t/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1IjoiYXJhemE0MTAiLCJhIjoiY2t0M3htODRhMHlkZTJ2cGhrMGd1azhycSJ9.XrIlf9qKq3uT3J8r1vRRUw', {
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 18,
        renderer: L.canvas(),
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/light-v9',
        tileSize: 512,
        zoomOffset: -1
    }).addTo(map);

    function polygon(id) {
        if (states_polygons != "") {
            states_polygons.remove();
        }

        // var button = $(event.relatedTarget);
        // var id = button.data('id');
        var name = "";
        var json_tostring = "";

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        states_polygons = "";
        $.ajax({
            url: 'https://opvs.propsure.co/plot/getPolygon',
            type: 'POST',
            data: {
                _token: CSRF_TOKEN,
                id: id
            },
            dataType: 'JSON',
            success: function (responseData) {
                name = responseData.features[0].properties.name;
                states_polygons = L.geoJSON(responseData);
                let centroid = states_polygons.getBounds().getCenter();
                L.marker(centroid).addTo(map);
                states_polygons.setStyle({
                    fillColor: '#5F1404',
                    renderer: L.canvas()
                });
                map.fitBounds(states_polygons.getBounds());
                states_polygons.addTo(map);
                map.setZoom(18)
                imageSave()
                document.getElementById('gps_label').innerHTML = centroid.lat.toFixed(6) + " , " + centroid
                    .lng.toFixed(6)
            }
        });
    }

    last_segment = $('#plot_id_hash').val();

    polygon(last_segment);

    function imageSave() {
        // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        let imgSrc;
        leafletImage(map, function (err, canvas) {
            // now you have canvas
            // example thing to do with that canvas:
            var img = document.createElement('img');
            var dimensions = map.getSize();
            img.width = dimensions.x;
            img.height = dimensions.y;
            imgSrc = canvas.toDataURL();
            $('#img_src').val(imgSrc);

        });


    }
});

//ajax to submit data in opvs plot report table


document.getElementById('form_submit').onclick = function () {
    document.getElementById('form_submit').disabled = true
}
