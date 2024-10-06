
  angular.module('patientApp', [])
  .controller('Patient_hisController', ['$scope','$http','$filter', function($scope,$http,$filter){
        $scope.list = {};  //record
        // var myModal = new bootstrap.Modal('#exampleModal', {
        //     keyboard: false ,
        //     backdrop: true ,
        //     show: true
        //   });
        // var popupDelete = new bootstrap.Modal(document.getElementById('popupDelete'), {
        //     keyboard: false ,
        //     backdrop: true ,
        //     show: true
        //   });
          
        $scope.s = {'key': ""}; //null   
        $scope.select= function(hn){
          console.log(hn);
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
                }, 
                function(response){

                }
            );
        }
        $scope.select3= function(){
            $http({
                method: 'POST',
                url: '../admin/patient_his_select2.php',
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
    }
]);