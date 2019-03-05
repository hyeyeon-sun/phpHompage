<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Material Design Bootstrap</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="../mdb/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="../mdb/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="../mdb/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <canvas id="lineChart"></canvas>
            </div>
        </div>
    </div>

    <!-- JQuery -->
    <script type="text/javascript" src="../mdb/js/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="../mdb/js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="../mdb/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="../mdb/js/mdb.js"></script>

    <script>
        $(document).ready(function() {
          var korean_total = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
          var foreigner_total = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
          var tourist_total = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
              $.get('../jeju/jeju_korean.xml', function(data) {
                $(data).find("Row").each(function() {
                    if ($(this).find("구분").text() == "형태별") {
                        for (var i = 0; i < 12; i++) {
                          if(i < 9)
                            var name = "_2017년0" + (i + 1) + "월";
                          else
                            var name = "_2017년" + (i + 1) + "월";
                            korean_total[i] += Number($(this).find(name).text());
                            tourist_total[i] += Number($(this).find(name).text());
                        }
                    }
                })
              });
              $.get('../jeju/jeju_foreigner.xml', function(data) {
                $(data).find("Row").each(function() {
                    for (var i = 0; i < 12; i++) {
                      if(i < 9)
                        var name = "_2017년0" + (i + 1) + "월";
                      else
                        var name = "_2017년" + (i + 1) + "월";
                        foreigner_total[i] += Number($(this).find(name).text());
                        tourist_total[i] += Number($(this).find(name).text());
                    }
                })
              });
            setTimeout(function() { // Code here
            var ctxL = $("#lineChart")[0].getContext("2d");
            var myLineChart = new Chart(ctxL, {
                type: 'line',
                data: {
                    labels: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
                    datasets: [{
                            label: "한국인",
                            data: korean_total,
                            backgroundColor: [
                                'rgba(105, 0, 132, .2)',
                            ],
                            borderColor: [
                                'rgba(200, 99, 132, .7)',
                            ],
                            borderWidth: 2
                        },
                        {
                            label: "외국인",
                            data: foreigner_total,
                            backgroundColor: [
                                'rgba(0, 137, 132, .2)',
                            ],
                            borderColor: [
                                'rgba(0, 10, 130, .7)',
                            ],
                            borderWidth: 2
                        }
                    ]
                },
                options: {
                    responsive: true
                }
            });
          }, 100);
        })
    </script>






</body>

</html>