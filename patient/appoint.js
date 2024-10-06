angular.module('patientApp', [])
  .controller('AppointshowController', ['$scope','$http', function($scope,$http){
        $scope.select= function(){{ 
            }
            $http({
                method: 'POST',
                url: 'appoint_select.php',
                headers: {
                  'Content-Type': undefined
                },
                data: ""
            }).then(
                function(z){
                    $scope.list = z.data;
                    console.log(z.data);
                }, 
                function(response){

                }
            );
        }
        
  }]);