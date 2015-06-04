// Controllers

app.controller('UserController', ['$scope', '$http', 'users', '$stateParams', function($scope, $http, users, $stateParams) {

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
    $http.get('/api/user-limit?page='+pageNumber).success(function(response) {

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


  // Fetch User Data With Role
  users.all().then(function(users){
    $scope.users = users;
  });

  // Create User
  $scope.addUser = function() {
    $http.post('/api/users', {
        name: $scope.user.name,
        email: $scope.user.email,
        password: $scope.user.password
    }).success(function(data, status, headers, config) {
        $scope.users.push(data);
        $scope.user = '';
    });
  };

  // Delete User
  $scope.deleteUser = function(user) {
    $http.delete('/api/users/' + user.id)
        .success(function() {
          $scope.alerts.push({type: 'success', msg: 'Data Berhasil Dihapus...!'});
          for (index = 0; index < $scope.users.length; ++index) {
            if ($scope.users[index].id == user.id) {
              $scope.users.splice(index, 1);
            }
          }
        });
  };

}]);

app.controller('EditUserCtrl', ['$scope', 'users', '$stateParams', '$filter', '$http', 'editableOptions', 'editableThemes',
  function($scope, users, $stateParams, $filter, $http, editableOptions, editableThemes){
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
    users.get($stateParams.userId).then(function(user){
      $scope.user = user;
    });

    // Update User
    $scope.updateUser = function(user) {
        $http.put('/api/users/' + user.id, {
            name: user.name,
            email: user.email,
            password: user.password
        }).success(function(data, status, headers, config) {
            user = data;
        });
    };

}]);






// Services

app.factory('users', ['$http', function ($http) {
  var path = '/api/users';
  var users = $http.get('/api/users')
        .then(function(response) {
            return response.data;
        });
  var factory = {};

  // List Users Model
  factory.all = function () {
    return users;
  };

  // Get User Model
  factory.get = function (id) {
    return users.then(function(users){
      for (var i = 0; i < users.length; i++) {
        if (users[i].id == id) return users[i];
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