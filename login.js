

  angular.module('loginApp', [])
  .controller('loginController', ['$scope','$http', function($scope,$http){
    var popup = new bootstrap.Modal(document.getElementById('popup'), {
        keyboard: false ,
        backdrop: true ,
        show: true
      });
        $scope.login= function(){{ 
            $http({
                method: 'POST',
                url: 'login.php',
                headers: {
                  'Content-Type': undefined
                },
                data: $scope.s
            }).then(
                function(z){
                    // $scope.list = z.data;
                    
                   if(z.data.status == 1){
                        alert('เข้าสู่ระบบสำเร็จ')
                        if(z.data.position != "แพทย์"){
                          console.log('ผู้ป่วย');
                          window.location.assign("patient/appoint.php");  
                        } else {
                          console.log("แพทย์");
                          window.location.assign("admin/patient.php");  

                        }
                        
                   }else{
                    $scope.a ="ข้อมูลผู้ใช้งาน หรือ รหัสผ่านไม่ถูกต้อง"; 
                    popup.show();
                    } 
                    
                }, 
                function(response){    
                }
            );
            }   //window.location.assign("appoint.php");      
        }
  }]);