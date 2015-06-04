app.controller('UserController', ['$scope', 'users', '$stateParams', function($scope, users, $stateParams) {
  users.all().then(function(users){
    $scope.users = users;
  });
}]);

app.controller('UserDetailCtrl', ['$scope', 'users', '$stateParams', function($scope, users, $stateParams) {
  users.get($stateParams.userId).then(function(user){
    $scope.user = user;
  });
}]);

app.factory('users', ['$http', function ($http) {
  var path = '/api/users';
  var users = $http.get('/api/users')
        .then(function(response) {
            return response.data;
        });

  var factory = {};
  factory.all = function () {
    return users;
  };
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