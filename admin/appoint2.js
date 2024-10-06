angular.module('patientApp', [])
    .controller('Appoint2Controller', ['$scope', '$http', '$filter', '$location', function ($scope, $http, $filter, $location) {
        $scope.list = {};  //record
        var myModal = new bootstrap.Modal(document.getElementById('popup'), {
            keyboard: false,
            backdrop: true,
            show: true
        });
        $scope.s = { 'key': "", 'date0': new Date(), 'status': "", 'time': "" };
        //$scope.Datenow = Date.now();
        // $scope.s.date


        $scope.checkDatae = function(){

        }
        $scope.select = function () {
            {
            
                $scope.s.date = $filter('date')($scope.s.date0, "yyyy-MM-dd");
               
            }
            $http({
                method: 'POST',
                url: 'appoint2_select.php',
                headers: {
                    'Content-Type': undefined
                },
                data: $scope.s
            }).then(
                function (z) {
                    $scope.list = z.data;
                },
                function (response) {

                }
            );
        }
        $scope.s = { 'date0': new Date(), 'status': "", 'time': "", 'month': "" };
        $scope.select2 = function (a) {
            $scope.s.date = $filter('date')($scope.s.date0, "yyyy-MM-dd");
            $scope.s.month = $filter('date')($scope.s.month0, "yyyy-MM");
            $http({
                method: 'POST',
                url: 'report_appoint2.php',
                headers: {
                    'Content-Type': undefined
                },
                data: $scope.s
            }).then(
                function (a) {
                    $scope.list = a.data[0];
                    $scope.list2 = a.data[1];
                    $scope.list3 = a.data[2];
                },
                function (response) {

                }
            );
        }
        //แสดงผลข้อมูลตอน keyy
        $scope.s = { 'date0': new Date(), 'status': "", 'time': "", 'key': "" };
        $scope.select3 = function () {
            $scope.s.date = $filter('date')($scope.s.date0, "yyyy-MM-dd");
            $http({
                method: 'POST',
                url: 'appoint2_select2.php',
                headers: {
                    'Content-Type': undefined
                },
                data: $scope.s
            }).then(
                function (a) {
                    $scope.list3 = a.data;
                },
                function (response) {

                }
            );
        }
        $scope.showupdatefrom_app = function (app) {
            $scope.f3 = app;
            $scope.f3.appointment_date = new Date($scope.f3.appointment_date); // เข้าปฏิทินได้เลย 
            $http({
                method: 'POST',
                url: 'admin_hisadd_select.php',
                headers: {
                    'Content-Type': undefined
                },
                data: ""
            }).then(
                function (z) {
                    $scope.adminlist = z.data;
                },
                function (response) {

                }
            );
        }
        $scope.delete = function (idpatient) {
            $http({
                method: 'POST',
                url: 'appoint2_delete.php',
                headers: {
                    'Content-Type': undefined
                },
                data: { 'idappointment': idappointment }
            }).then(
                function (data) {
                    if (response.data == 1) { $scope.a = "ลบข้อมูลสำเร็จแล้ว"; }
                    else { $scope.a = "ลบข้อมูลไม่สำเร็จแล้ว"; }
                    myModal.show();
                    location.replace("appoint2.php");
                },
                function (response) {

                }
            );
        }
        $scope.insert = function () {
            $scope.f2.date = $scope.f2.date.toISOString().split("T", 2)[0];
            //$scope.s.date = new Date ($scope.s.date);
            //$scope.f.date = $filter('date')($scope.f2.date, "yyyy-MM-dd");
            $http({
                method: 'POST',
                url: 'appoint2_insert.php',
                headers: {
                    'Content-Type': undefined
                },
                data: $scope.f2
            }).then(
                function (response) {
                    if (response.data == 1) { $scope.a = "บันทึกข้อมูลสำเร็จแล้ว"; }
                    else { $scope.a = "บันทึกข้อมูลไม่สำเร็จแล้ว"; }
                    myModal.show();
                },
                function (response) {

                }
            );
        }
        $scope.update = function () {
            $scope.f3.appointment_date2 = $filter('date')($scope.f3.appointment_date, "yyyy-MM-dd");
            $http({
                method: 'POST',
                url: 'appoint2_update.php',
                headers: {
                    'Content-Type': undefined
                },
                data: $scope.f3
            }).then(
                function (response) {
                    if (response.data == 1) { $scope.a = "แก้ไขสำเร็จ"; }
                    else { $scope.a = "แก้ไขไม่สำเร็จ"; }
                    myModal.show();
                    location.replace("appoint2.php");
                },
                function (response) {

                }
            );
        }
        $scope.switchStatus = function (a, b) {
            $http({
                method: 'POST',
                url: 'status_update.php',
                headers: {
                    'Content-Type': undefined
                },
                data: { 'aa': a, 'bb': b }
            }).then(
                function (response) {
                    if (response.data == 1) { $scope.a = "แก้ไขสำเร็จ"; }
                    else { $scope.a = "แก้ไขไม่สำเร็จ"; }
                    myModal.show();
                },
                function (response) {

                }
            );
        }
        $scope.appoint = function (a) {
            var x = "?";
            x += "&hn=" + a.HN;
            x += "&name=" + a.patient_name;
            x += "&lastname=" + a.patient_lastname;
            x += "&date=" + a.appointment_date;
            x += "&time=" + a.time_name;
            x += "&reason=" + a.reason_name;
            x += "&location=" + a.location_name;
            x += "&adname=" + a.admin_name;
            x += "&adlastname=" + a.admin_lastname;
            window.location.assign("appoint_data.php" + x);
            // var y = JSON.stringify(a);
            // window.location.assign("appoint_data.php?"+y);
        }
        $scope.print = function () {
            var doc = new jsPDF();
            doc.text("Hello, this is a generated PDF using AngularJS and jsPDF.", 10, 10);
            doc.save("generated.pdf");
        };



        $scope.sendLine = function (val) {
            console.log(val.HN);
            $http({
                method: 'POST',
                url: 'sendLineToken.php',
                headers: {
                    'Content-Type': undefined
                },
                data: { hn: val.HN , data:val}
            }).then(
                function (response) {
                    console.log(response);
                },
                function (response) {

                }
            );
        }








    }]);