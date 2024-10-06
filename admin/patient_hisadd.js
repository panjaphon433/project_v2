angular.module('patientApp', [])
  .controller('Patient_hisaddController', ['$scope','$http','$filter', function($scope,$http,$filter){
        $scope.list = {};  //record
        var myModal = new bootstrap.Modal(document.getElementById('popup'), {
            keyboard: false
          });

        $scope.select= function(){
           
            if(!$scope.s) // if a is negative,undefined,null,empty value then...
            {
                //$scope.s.key = ""; // select
                $scope.s = {'key': ""};
            }
            $http({
                method: 'POST',
                url: 'patient_hisadd_select.php',
                headers: {
                  'Content-Type': undefined
                },
                data: $scope.s
            }).then(
                function(z){
                    $scope.list = z.data;
                }, 
                function(response){

                }
            );
        }
        $scope.select2= function(a){
            $http({
                method: 'POST',
                url: 'patient_hisadd_select2.php',
                headers: {
                  'Content-Type': undefined
                },
                data: {'idappointment':a}
            }).then(
                function(a){
                    $scope.list = a.data;
                }, 
                function(response){

                }
            );
        }
        // $scope.f2.date_treatment = new Date($scope.f2.date_treatment);
        // $scope.f2 = {'date_treatment1': new Date()};
        $scope.showupdatefrom = function(pat){
                $scope.f2 = pat;
                $scope.f2.date_treatment = new Date();
                $http({
                    method: 'POST',
                    url: 'admin_hisadd_select.php',
                    headers: {
                      'Content-Type': undefined
                    },
                    data: ""
                }).then(
                    function(z){
                        $scope.adminlist = z.data;
                    }, 
                    function(response){
                        
                    }
                ); 

        }
        $scope.delete = function(idpatient_history){
            $http({
                method: 'POST',
                url: 'patient_hisadd_delete.php',
                headers: {
                  'Content-Type': undefined
                },
                data: {'idpatient_history':idpatient_history} 
            }).then(
                function(data){
                    if(response.data == 1){$scope.a ="ลบข้อมูลสำเร็จแล้ว";}
                    else{$scope.a ="ลบข้อมูลไม่สำเร็จแล้ว";}     
                      myModal.show();
                }, 
                function(response){

                }
            );
        }
        $scope.f2 = {'iddisease':"",'detail':"",'date_treatment':"",'idadmin':""};
        $scope.insert = function(){
            // if(!$scope.f2.idallergy){
            //     $scope.f2.idallergy = "";
            // }
            $scope.f2.date_treatment2 = $filter('date')($scope.f2.date_treatment, "yyyy-MM-dd");
            $http({
                method: 'POST',
                url: 'patient_hisadd_insert.php',
                headers: {
                  'Content-Type': undefined
                },
                data: $scope.f2
            }).then(
                function(response){
                    if(response.data == 1){
                        var y = document.getElementById("disease"); 
                        var y1 = y.selectedIndex;
                        var y2 = y.options[y1].text;
                        $scope.a ="บันทึกข้อมูลสำเร็จแล้ว " + String.fromCharCode(10); 
                        $scope.a += "HN:    "+ $scope.f2.HN + String.fromCharCode(10); 
                        $scope.a += "ชื่อ-สกุลผู้ป่วย:    " + $scope.f2.patient_name + " " + $scope.f2.patient_lastname + String.fromCharCode(10); 
                        $scope.a += "โรคที่ป่วย:    " + y2 + String.fromCharCode(10);  
                        $scope.a += "วันที่ทำการรักษา:    "+ $filter('date')($scope.f2.date_treatment, "dd-MM-yyyy") ;}
                    else{$scope.a ="บันทึกข้อมูลไม่สำเร็จแล้ว";}     
                      myModal.show();
                }, 
                function(response){
                }
            );
        }
        $scope.update = function(){
            $scope.f3.date_treatment2 = $filter('date')($scope.f3.date_treatment, "dd-MM-yyyy");
            $http({
                method: 'POST',
                url: 'patient_hisadd_update.php',
                headers: {
                  'Content-Type': undefined
                },
                data: $scope.f3
            }).then(
                function(response){
                    if(response.data == 1){$scope.a ="แก้ไขสำเร็จ";}
                    else{$scope.a ="แก้ไขไม่สำเร็จ";}     
                      myModal.show();
                }, 
                function(response){

                }
            );
        }
        $scope.show = function(){
            window.location.assign("patient_his.php");
        }
        //test
        // $scope.test = function(){
        //     var myModal = new bootstrap.Modal(document.getElementById('popup'), {
        //         keyboard: false
        //       });
        //       myModal.show();
        // }
            











  }]);