angular.module('patientApp', [])
  .controller('PatientshowController', ['$scope','$http', function($scope,$http){
        $scope.list = {};  //record
        var myModal = new bootstrap.Modal(document.getElementById('popup'), {
            keyboard: false ,
            backdrop: true ,
            show: true
          });
          
        $scope.select = function(){
            $http({
                method: 'POST',
                url: 'profile_select.php',
                headers: {
                  'Content-Type': undefined
                },
                data: ""
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
                url: 'profile2_select.php',
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
  }])
;