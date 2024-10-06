angular.module('patientApp', [])
    .controller('PatientController', ['$scope', '$http', '$filter', '$location', function ($scope, $http, $filter, $location) {
        $scope.list = {};  //record
        var myModal = new bootstrap.Modal(document.getElementById('popup1'), {
            keyboard: false,
            backdrop: true,
            show: true
        });
        var popupInsert = new bootstrap.Modal(document.getElementById('popupInsert'), {
            keyboard: false,
            backdrop: true,
            show: true
        });
        var popupDelete = new bootstrap.Modal(document.getElementById('popupDelete'), {
            keyboard: false,
            backdrop: true,
            show: true
        });

        // set เป็น null ป้องกัน
        $scope.f = {
            'name': "", 'lastname': "", 'idcard': "", 'sex': "", 'birthday': "", 'phone': "", 'address': "", 'blood': "",
            'nation': "", 'race': "", 'religion': "", 'degree': "", 'marital': "", 'occupation': "", 'right': "",
            'mom_name': "", 'mom_idcard': "", 'dad_name': "", 'dad_idcard': "", 'spouse_name': "", 'spouse_idcard': ""
        };

        $scope.clearIfNotNumber = function () {


            if ($scope.f.idcard) {
                return $scope.f.idcard = $scope.f.idcard.replace(/[^0-9]/g, '');
            }

            if ($scope.f.phone) {
                return $scope.f.phone = $scope.f.phone.replace(/[^0-9]/g, '');

            }




        };

        $scope.s = { 'key': "" }; //null 
        $scope.select = function () {
            //scope.s.date =  $filter('date')($scope.f2.patient_birthday, "yyyy-MM-dd"); 
            $http({
                method: 'POST',
                url: 'patient_select.php',
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
        $scope.predicate = "HN";

        $scope.select2 = function (HN) {
            $http({
                method: 'POST',
                url: 'patient_select2.php',
                headers: {
                    'Content-Type': undefined
                },
                data: { 'HN': HN }
            }).then(
                function (z) {
                    $scope.list2 = z.data;
                },
                function (response) {

                }
            );
        }

        $scope.s = { 'key': "" }; //null 
        $scope.select3 = function (z) {
            //    $scope.s.date = 
            $http({
                method: 'POST',
                url: 'patient_select3.php',
                headers: {
                    'Content-Type': undefined
                },
                data: $scope.s
            }).then(
                function (z) {
                    $scope.list = z.data[0];
                    $scope.list2 = z.data[1];
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',  // or 'bar', 'pie', 'doughnut' etc. depending on your requirement
                        data: {
                            labels: $scope.list,  // x-axis labels
                            datasets: [{
                                label: 'Dataset 1',  // Label for the dataset
                                data: $scope.list2,  // Data to plot
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',  // Background color for the points/line/bar
                                borderColor: 'rgba(75, 192, 192, 1)',  // Border color for the points/line/bar
                                borderWidth: 1  // Width of the line/border
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true  // Start y-axis from 0
                                }
                            }
                        }
                    });
                },
                function (response) {

                }
            );
        }
        $scope.showupdatefrom = function (pat) {
            $scope.f2 = pat;
            $scope.f2.patient_birthday = new Date($scope.f2.patient_birthday); // เข้าปฏิทินได้เลย show วันที่ 
            $http({
                method: 'POST',
                url: 'patient_select2.php',
                headers: {
                    'Content-Type': undefined
                },
                data: { 'HN': $scope.f2.HN }
            }).then(
                function (z) {
                    $scope.f3 = z.data[0]; //model มันส่งเป็น array อยากได้
                },
                function (response) {

                }
            );
        }
        $scope.delete = function (abc) {
            $http({
                method: 'POST',
                url: 'patient_delete.php',
                headers: {
                    'Content-Type': undefined
                },
                data: { 'HN': abc }
            }).then(
                function (response) {
                    if (response.data == 1) { $scope.a = "ลบข้อมูลสำเร็จแล้ว"; }
                    else { $scope.a = "ลบข้อมูลไม่สำเร็จแล้ว"; }

                    //myModal.hide();  
                    //myModal.data('bs.modal')._config.backdrop = true;  
                    popupDelete.show();
                    location.replace("patient.php");  //เด้งไปหน้า
                },
                function (response) {

                }
            );
        }
        $scope.confirmDelete = function (z) {
            $scope.goingTodelete = z;
        }
        // $scope.delete2 = function(HN){
        //     $http({
        //         method: 'POST',
        //         url: 'patient_delete.php',
        //         headers: {
        //           'Content-Type': undefined
        //         },
        //         data: {'HN':HN} 
        //     }).then(
        //         function(response){
        //             if(response.data == 1){$scope.a ="ลบข้อมูลสำเร็จแล้ว";}
        //             else{$scope.a ="ลบข้อมูลไม่สำเร็จแล้ว";}  

        //               //myModal.hide();  
        //               //myModal.data('bs.modal')._config.backdrop = true;  
        //               popupDelete2.show();
        //         }, 
        //         function(response){

        //         }
        //     );
        // }

        $scope.insert = function () {
            console.log($scope.f);
            $scope.f.birthday2 = $filter('date')($scope.f.birthday, "yyyy-MM-dd");
            var x = true;
            if ($scope.f.phone == "") { x = false; }
            else if ($scope.f.name == "") { x = false; }
            else if ($scope.f.lastname == "") { x = false; }
            else if ($scope.f.idcard == "") { x = false; }
            else if ($scope.f.birthday == "") { x = false; }
            else if ($scope.f.password == "") { x = false; }
            else if ($scope.f.idcard.length < 13) {
                alert('กรอกบัตรประชาชนให้ถูกต้อง !!')
                return
            }
            else if ($scope.f.phone.length < 10) {
                alert('กรอกเบอร์โทรให้ครบ !!')
                return

            }

            if (x == true) {
                $http({
                    method: 'POST',
                    url: 'patient_insert.php',
                    headers: {
                        'Content-Type': undefined
                    },
                    data: $scope.f
                }).then(
                    function (response) {
                        if (response.data == 0) { $scope.b = "มีข้อมูลผู้ใช้นี้อยู่ในระบบแล้ว"; }
                        else if (response.data == 1) { $scope.b = "บันทึกข้อมูลสำเร็จแล้ว"; }
                        else { console.log(response.data); $scope.b = "บันทึกข้อมูลไม่สำเร็จแล้ว"; }
                        popupInsert.show();
                        // location.replace("patient.php");  //เด้งไปหน้า
                    },
                    function (response) {

                    }
                );
            } else {
                $scope.a = "กรุณาข้อมูลให้ครบถ้วน"
                myModal.show();
            }
        }
        $scope.update = function () {
            $scope.f2.patient_birthday2 = $filter('date')($scope.f2.patient_birthday, "yyyy-MM-dd");
            $http({
                method: 'POST',
                url: 'patient_update.php',
                headers: {
                    'Content-Type': undefined
                },
                data: [$scope.f2, $scope.f3]
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
        //test 
        // $scope.test = function(){
        //     var myModal = new bootstrap.Modal(document.getElementById('popup'), {
        //         keyboard: false
        //       });
        //       myModal.show();
        // }          
    }])
    .filter('tel123', function () {
        return function (telx) {
            if (!telx) { return ''; }

            var value = telx.toString().trim().replace(/^\+/, '');

            if (value.match(/[^0-9]/)) {
                return telx;
            } else {
                return "";
            }
        };
    })
    ;

