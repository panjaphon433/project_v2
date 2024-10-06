angular.module('patientApp', [])
  .controller('AdminController', ['$scope','$http','$filter','$location', function($scope,$http,$filter,$location){
        $scope.list = {};  //record
        var myModal = new bootstrap.Modal(document.getElementById('popup1'), {
            keyboard: false ,
            backdrop: true ,
            show: true
          });
          var popupInsert = new bootstrap.Modal(document.getElementById('popupInsert'), {
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
        $scope.select = function(){
            //scope.s.date =  $filter('date')($scope.f2.patient_birthday, "yyyy-MM-dd"); 
            $http({
                method: 'POST',
                url: 'admin_select.php',
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
        $scope.predicate = "HN"; 
     
        $scope.select2 = function(HN){
            $http({
                method: 'POST',
                url: 'patient_select2.php',
                headers: {
                  'Content-Type': undefined
                },
                data: {'HN':HN} 
            }).then(
                function(z){ 
                    $scope.list2 = z.data;
                }, 
                function(response){

                }
            );
        }
        $scope.s = {'key': ""}; //null 
        $scope.select3 = function(z){
        //    $scope.s.date = 
            $http({
                method: 'POST',
                url: 'patient_select3.php',
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
            $scope.f2 = pat;
            $http({
                method: 'POST',
                url: 'admin_select.php',
                headers: {
                  'Content-Type': undefined
                },
                data: {'admin_idcard':$scope.f2.admin_idcard} 
            }).then(
                function(z){ 
                    $scope.f3 = z.data[0]; //model มันส่งเป็น array อยากได้
                }, 
                function(response){

                }
            );
    }

        $scope.delete = function(abc){
            $http({
                method: 'POST',
                url: 'admin_delete.php',
                headers: {
                  'Content-Type': undefined
                },
                data: {'admin_idcard':abc} 
            }).then(
                function(response){
                    if(response.data == 1){$scope.a ="ลบข้อมูลสำเร็จแล้ว";}
                    else{$scope.a ="ลบข้อมูลไม่สำเร็จแล้ว";}  
                    
                      //myModal.hide();  
                      //myModal.data('bs.modal')._config.backdrop = true;  
                      popupDelete.show();
                      location.replace("admin.php");  //เด้งไปหน้า
                }, 
                function(response){

                }
            );
        }
        $scope.confirmDelete = function(z){
            $scope.goingTodelete = z; 
        }
        
        // set เป็น null ป้องกัน
        $scope.f = {'admin_name': "",'admin_lastname':"",'admin_idcard':"",'admin_position':"",'admin_username':"",'admin_password':""};
        $scope.insert = function(){
            var x = true; 
            if($scope.f.admin_name ==""){x = false;}
            else if($scope.f.admin_lastname ==""){x = false;}
            else if($scope.f.admin_position ==""){x = false;}
            else if($scope.f.admin_idcard==""){x = false;}
            else if($scope.f.admin_username ==""){x = false;}
            else if($scope.f.admin_password ==""){x = false;}
            if(x == true){
                    $http({
                        method: 'POST',
                        url: 'admin_insert.php',
                        headers: {
                        'Content-Type': undefined
                        },
                        data: $scope.f
                    }).then(
                        function(response){ 
                            if(response.data == 0){  $scope.b ="มีข้อมูลผู้ใช้นี้อยู่ในระบบแล้ว";}
                            else if(response.data == 1){ $scope.b ="บันทึกข้อมูลสำเร็จแล้ว";}
                            else{ $scope.b ="บันทึกข้อมูลไม่สำเร็จแล้ว";} 
                            popupInsert.show(); 
                            location.replace("admin.php");  //เด้งไปหน้า
                        }, 
                        function(response){
                            // console.log(9);    146 console.log(response.data);
                        }
                    );
            }else{
                $scope.a = "กรุณาข้อมูลให้ครบถ้วน"
                myModal.show();
            }
        }
        $scope.update = function(){
            $http({
                method: 'POST',
                url: 'admin_update.php',
                headers: {
                  'Content-Type': undefined
                },
                data: [$scope.f2]
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
        }else{
            return "";
        }
    };
    })
  ;