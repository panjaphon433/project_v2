angular.module('patientApp', [])
  .controller('Patient_hisController', ['$scope','$http','$filter', function($scope,$http,$filter){
        $scope.list = {};  //record
        var myModal = new bootstrap.Modal('#exampleModal', {
            keyboard: false ,
            backdrop: true ,
            show: true
          });
        var popupDelete = new bootstrap.Modal(document.getElementById('popupDelete'), {
            keyboard: false ,
            backdrop: true ,
            show: true
          });
          
        $scope.s = {'key': ""}; //null   
        $scope.select= function(){
            $http({
                method: 'POST',
                url: 'patient_his_select.php',
                headers: {
                  'Content-Type': undefined
                },
                data: $scope.s
            }).then(
                function(z){
                    $scope.list = z.data;
                    console.log(z);
                }, 
                function(response){
                    console.log(response);
                }
            );
        }
        $scope.select3= function(){
            $http({
                method: 'POST',
                url: 'patient_his_select2.php',
                headers: {
                  'Content-Type': undefined
                },
                data: $scope.s
            }).then(
                function(z){
                    $scope.list3 = z.data;
                }, 
                function(response){

                }
            );
        }

        $scope.s = { 'disease': ""};
        $scope.select2 = function(z){
            // $scope.s.date = $filter('date')($scope.s.date0, "yyyy-MM-dd");
            $http({
                method: 'POST',
                url: 'report_patient_his2.php',
                headers: {
                  'Content-Type': undefined
                },
                data: $scope.s
            }).then(
                function(z){ 
                    $scope.list = z.data[0];
                    $scope.list2 = z.data[1];
                }, 
                function(response){

                }
            );
        }
        $scope.showupdatefrom = function(pat){
                $scope.f3 = pat; 
                console.log($scope.f3);
                $scope.f3.date_treatment = new Date($scope.f3.date_treatment);
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
                url: 'patient_his_delete.php',
                headers: {
                  'Content-Type': undefined
                },
                data: {'idpatient_history':idpatient_history} 
            }).then(
                function(response){
                    if(response.data == 1){$scope.a ="ลบข้อมูลสำเร็จแล้ว";}
                    else{$scope.a ="ลบข้อมูลไม่สำเร็จแล้ว";}     
                    // e.preventDefault(); 
                    popupDelete.show();
                }, 
                function(response){

                }
            );
        }


        $scope.confirmDelete = function(z){
            $scope.goingTodelete = z; 
            
        }

        $scope.insert = function(){
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
                    if(response.data == 1){$scope.a ="บันทึกข้อมูลสำเร็จแล้ว";}
                    else{$scope.a ="บันทึกข้อมูลไม่สำเร็จแล้ว";}     
                      myModal.show();
                }, 
                function(response){

                }
            );
        }
        $scope.update = function(){
            $scope.f3.date_treatment2 = $filter('date')($scope.f3.date_treatment, "yyyy-MM-dd");
            
            $http({
                method: 'POST',
                url: 'patient_his_update.php',
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
            )
        }
    }
        //test
        // $scope.test = function(){
        //     var myModal = new bootstrap.Modal(document.getElementById('popup'), {
        //         keyboard: false
        //       });
        //       myModal.show();
        // }
            











]);