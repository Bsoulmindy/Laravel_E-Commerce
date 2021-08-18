<x-head/>
    <body>
        <x-header-admin active="stats du site"/>
        <main>
            <x-panel-options active='{{ $active }}'/>
            <div>
                <div class="text-center my-5">
                    <span class="fs-2">Résultat analytique totale : <span class="text-primary fw-bold">{{ $resultatTotal }} DH</span></span>
                </div>
                <div class="d-flex flex-row justify-content-center">
                    <div id="chartMois" style="height: 300px; width: 75%;"></div>
                </div>
                <div class="d-flex flex-row justify-content-center mt-5">
                    <div id="chartJour" style="height: 300px; width: 75%;"></div>
                </div>
            </div>
        </main>
        <script src={{ asset("js/bootstrap.min.js") }}></script>
        <script src={{ asset("js/bootstrap.bundle.min.js") }}></script>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <script>
            window.onload = function () {

            var chart = new CanvasJS.Chart("chartMois", {
                animationEnabled: true,
                exportEnabled: true,
                theme: "dark2", // "light1", "light2", "dark1", "dark2"
                title:{
                    text: "Résultat analytique des mois précédents"
                },
                axisY: {
                    suffix: " DH",
                    includeZero: true
                },
                data: [{
                    type: "column", //change type to bar, line, area, pie, etc
                    indexLabelFontColor: "#5A5757",
                    indexLabelFontSize: 16,
                    indexLabelPlacement: "outside",
                    dataPoints: [
                        @foreach ($resultatMois as $resultat)
                        { label: '{{ $resultat[1] }}', y: {{ $resultat[0] }} },
                        @endforeach
                    ]
                }]
            });

            var chart2 = new CanvasJS.Chart("chartJour", {
                animationEnabled: true,
                exportEnabled: true,
                theme: "dark2", // "light1", "light2", "dark1", "dark2"
                title:{
                    text: "Résultat analytique des jours précédents"
                },
                axisY: {
                    suffix: " DH",
                    includeZero: true
                },
                data: [{
                    type: "spline", //change type to bar, line, area, pie, etc
                    indexLabelFontColor: "#5A5757",
                    indexLabelFontSize: 16,
                    indexLabelPlacement: "outside",
                    dataPoints: [
                        @foreach ($resultatJour as $resultat)
                        { label: '{{ $resultat[1] }}', y: {{ $resultat[0] }} },
                        @endforeach
                    ]
                }]
            });

            chart.render();
            chart2.render();

            }
        </script>
    </body>
</html>