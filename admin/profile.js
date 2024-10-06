angular.module('adminApp', [])
  .controller('AdminshowController', ['$scope','$http', function($scope,$http){
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
  }])
;