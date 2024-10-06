angular.module('patientApp', [])
    .controller('GraphController', ['$scope', '$http', '$filter', function ($scope, $http, $filter) {



        $scope.select3 = function () {
            $http({
                method: 'POST',
                url: 'patient_select3.php',
                headers: {
                    'Content-Type': undefined
                },
                data: $scope.s
            }).then(
                function (z) {
                    $scope.listData = z.data
                    var grapList = z.data;
                    
                    // เตรียมข้อมูลสำหรับกราฟ
                    var villageData = {};
                    var diseases = new Set();

                    // แยกข้อมูลตามหมู่บ้านและโรค
                    grapList.forEach(function (item) {
                        if (!villageData[item.village_no]) {
                            villageData[item.village_no] = {};
                        }

                        villageData[item.village_no][item.disease_name] = parseInt(item.total_patients);
                        diseases.add(item.disease_name);
                    });

                    // เตรียม Label (หมู่บ้าน)
                    var villageLabels = Object.keys(villageData);

                    // เตรียมข้อมูลผู้ป่วยของแต่ละโรค
                    var datasets = [];
                    diseases.forEach(function (disease) {
                        var data = villageLabels.map(function (village_no) {
                            return villageData[village_no][disease] || 0; // ถ้าไม่มีโรคในหมู่บ้านนั้นให้แสดง 0
                        });

                        datasets.push({
                            label: disease,
                            data: data,
                            backgroundColor: fixedColors[disease], // ใช้สีที่กำหนดตามโรค
                            borderColor: fixedColors[disease],
                            borderWidth: 1
                        });
                    });

                    // สร้างกราฟ
                    createChart(villageLabels, datasets);
                },
                function (response) {
                    console.log('Error:', response);
                }
            );
        };

        // ฟังก์ชันสำหรับสร้างกราฟโดยใช้ Chart.js
        function createChart(labels, datasets) {
            var ctx = document.getElementById('myChart').getContext('2d');



            // สร้างกราฟใหม่
            window.myChart = new Chart(ctx, {
                type: 'bar', // ประเภทกราฟเป็น bar chart
                data: {
                    labels: labels, // หมู่บ้าน
                    datasets: datasets // ข้อมูลโรค
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // กำหนดสีคงที่สำหรับแต่ละโรค
        // กำหนดสีคงที่สำหรับแต่ละโรค
        var fixedColors = {
            "โรคหัวใจ": "rgba(255, 99, 132, 0.6)",
            "โรคตา": "rgba(54, 162, 235, 0.6)",
            "โรคฟันและเหงือก": "rgba(75, 192, 192, 0.6)",
            "โรคอ้วน": "rgba(153, 102, 255, 0.6)",
            "โรคเกี่ยวกับระบบทางเดินอาหาร": "rgba(255, 159, 64, 0.6)",
            "โรคซึมเศร้าและวิตกกังวล": "rgba(255, 206, 86, 0.6)",
            "โรคปอด": "rgba(75, 192, 192, 0.6)",
            "โรคมะเร็ง": "rgba(153, 102, 255, 0.6)",
            "โรคอื่นๆ": "rgba(255, 99, 132, 0.6)",
            "โรคความดันสูง": "rgba(54, 162, 235, 0.6)",
            "โรคเบาหวาน": "rgba(255, 206, 86, 0.6)",
            "โรคไขมัน": "rgba(75, 192, 192, 0.6)",
            "โรคเกาท์": "rgba(255, 159, 64, 0.6)",
            "โรคหลอดเลือดในสมอง": "rgba(153, 102, 255, 0.6)",
            "โรคระบบทางเดินหายใจเรื้อรัง": "rgba(255, 206, 86, 0.6)",
            "โรคไตเรื้อรัง": "rgba(54, 162, 235, 0.6)",
            "โรคตับแข็ง": "rgba(75, 192, 192, 0.6)"
        };










    }]);
