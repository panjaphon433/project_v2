angular.module('patientApp', [])
  .controller('AppointController', ['$scope','$http','$filter',function($scope,$http,$filter){
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
                url: 'appoint_select.php',
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
                url: 'appoint_select2.php',
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
        $scope.showupdatefrom_app = function(pat){
                $scope.f2 = pat;
                $scope.f2.appointment_date0 = $filter('date')(new Date(), "yyyy-MM-dd");
                $scope.f2.appointment_date1 = new Date();
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
        $scope.delete = function(idpatient){
            $http({
                method: 'POST',
                url: 'appoint_delete.php',
                headers: {
                  'Content-Type': undefined
                },
                data: {'idappointment':idappointment} 
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
        $scope.f2 = {'appointment_date1':"",'appointment_time':"",'appointment_reason':"",'detail':"",'appointment_location':"",'idadmin':""};
        $scope.insert = function(){
            //$scope.f2.appointment_date =  $scope.f2.appointment_date.toISOString().split("T",2)[0];
            $scope.f2.appointment_date2 = $filter('date')($scope.f2.appointment_date1, "yyyy-MM-dd");
            $http({
                method: 'POST',
                url: 'appoint_insert.php',
                headers: {
                  'Content-Type': undefined
                },
                data: $scope.f2
            }).then(
                function(response){
                    if(response.data == 1){$scope.a ="บันทึกข้อมูลสำเร็จแล้ว";}
                    else{$scope.a ="บันทึกข้อมูลไม่สำเร็จแล้ว";}     
                      myModal.show();
                }, 
                function(response){
                }
            );
            //  window.location.assign("appoint2.php");
        }
        $scope.update = function(){
            $scope.f2.birthday = $filter('date')($scope.f2.date, "dd-MM-yyyy");
            $http({
                method: 'POST',
                url: 'appoint_update.php',
                headers: {
                  'Content-Type': undefined
                },
                data: $scope.f2
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
            window.location.assign("appoint2.php");
        }
        //test
        // $scope.test = function(){
        //     var myModal = new bootstrap.Modal(document.getElementById('popup'), {
        //         keyboard: false
        //       });
        //       myModal.show();
        // }
            











  }]);