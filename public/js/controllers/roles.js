// Controllers

app.controller('RolesController', ['$scope', '$http', 'roles', '$stateParams', function($scope, $http, roles, $stateParams) {

  // Default Alerts
  $scope.alerts = [];

  // Success Added Alert
  $scope.added = function() {
    $scope.alerts.push({type: 'success', msg: 'Data Berhasil Ditambahkan...!'});
  };

  // Close Alert
  $scope.close = function(index) {
    $scope.alerts.splice(index, 1);
  };

  // Fetch Data With Pagination
  $scope.posts      = [];
  $scope.totalPages = 0;
  $scope.currentPage= 1;
  $scope.range      = [];

  $scope.getPosts = function(pageNumber){

    if(pageNumber===undefined){
      pageNumber = '1';
    }
    $http.get('/api/role-limit?page='+pageNumber).success(function(response) {

    $scope.posts      = response.data;
    $scope.totalPages = response.last_page;
    $scope.currentPage= response.current_page;
    $scope.per_page   = response.per_page;
    $scope.total      = response.total;
    $scope.awal       = (response.current_page - 1) * response.per_page + 1;
    $scope.akhir      = Math.min(response.total, response.current_page * response.per_page);

    // Pagination Range
    var pages = [];
    for(var i=1;i<=response.last_page;i++) {
      pages.push(i);
    }

    $scope.range = pages;

    });
  };


  // Fetch Role Data With Role
  roles.all().then(function(roles){
    $scope.roles = roles;
  });

  // Create Role
  $scope.addRole = function() {
    $http.post('/api/roles', {
        name: $scope.role.name,
        display_name: $scope.role.display_name,
        description: $scope.role.description
    }).success(function(data, status, headers, config) {
        $scope.roles.push(data);
        $scope.role = '';
    });
  };

  // Delete Role
  $scope.deleteRole = function(role) {
    $http.delete('/api/roles/' + role.id)
        .success(function() {
          $scope.alerts.push({type: 'success', msg: 'Data Berhasil Dihapus...!'});
          for (index = 0; index < $scope.roles.length; ++index) {
            if ($scope.roles[index].id == role.id) {
              $scope.roles.splice(index, 1);
            }
          }
        });
  };

}]);

app.controller('EditRolesCtrl', ['$scope', 'roles', '$stateParams', '$filter', '$http', 'editableOptions', 'editableThemes',
  function($scope, roles, $stateParams, $filter, $http, editableOptions, editableThemes){
    editableThemes.bs3.inputClass = 'input-sm';
    editableThemes.bs3.buttonsClass = 'btn-sm';
    editableOptions.theme = 'bs3';

    $scope.alerts = [];

    $scope.updated = function() {
      $scope.alerts.push({type: 'success', msg: 'Data Berhasil Diupdate...!'});
    };

    $scope.close = function(index) {
      $scope.alerts.splice(index, 1);
    };

    // Fetch Used Data by ID
    roles.get($stateParams.roleId).then(function(role){
      $scope.role = role;
    });

    // Update Role
    $scope.updateRole = function(role) {
        $http.put('/api/roles/' + role.id, {
            name: role.name,
            display_name: role.display_name,
            description: role.description
        }).success(function(data, status, headers, config) {
            role = data;
        });
    };

}]);






// Services

app.factory('roles', ['$http', function ($http) {
  var path = '/api/roles';
  var roles = $http.get('/api/roles')
        .then(function(response) {
            return response.data;
        });
  var factory = {};

  // List roles Model
  factory.all = function () {
    return roles;
  };

  // Get Role Model
  factory.get = function (id) {
    return roles.then(function(roles){
      for (var i = 0; i < roles.length; i++) {
        if (roles[i].id == id) return roles[i];
      }
      return null;
    });
  };

  return factory;
}]);

// Directive

app.directive('postsPagination', function(){
   return{
      restrict: 'E',
      template: '<ul class="pagination">'+
        '<li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getPosts(1)">&laquo;</a></li>'+
        '<li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getPosts(currentPage-1)">&lsaquo; Prev</a></li>'+
        '<li ng-repeat="i in range" ng-class="{active : currentPage == i}">'+
            '<a href="javascript:void(0)" ng-click="getPosts(i)">{{i}}</a>'+
        '</li>'+
        '<li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getPosts(currentPage+1)">Next &rsaquo;</a></li>'+
        '<li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getPosts(totalPages)">&raquo;</a></li>'+
      '</ul>'
   };
});