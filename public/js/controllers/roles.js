// Controllers

app.controller('UserController', ['$scope', '$http', 'users', '$stateParams', function($scope, $http, users, $stateParams) {
  users.all().then(function(users){
    $scope.users = users;
  });

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

  $scope.deleteUser = function(user) {
    $http.delete('/api/users/' + user.id)
        .success(function() {
          for (index = 0; index < $scope.users.length; ++index) {
            if ($scope.users[index].id == user.id) {
              $scope.users.splice(index, 1);
            }
          }
        });;
  };

}]);

app.controller('EditUserCtrl', ['$scope', 'users', '$stateParams', '$filter', '$http', 'editableOptions', 'editableThemes', 
  function($scope, users, $stateParams, $filter, $http, editableOptions, editableThemes){
    editableThemes.bs3.inputClass = 'input-sm';
    editableThemes.bs3.buttonsClass = 'btn-sm';
    editableOptions.theme = 'bs3';

    users.get($stateParams.userId).then(function(user){
      $scope.user = user;
    });

    $scope.updateUser = function(user) {
        $http.put('/api/users/' + user.id, {
            name: user.name,
            email: user.email,
            password: user.password
        }).success(function(data, status, headers, config) {
            user = data;
        });;
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