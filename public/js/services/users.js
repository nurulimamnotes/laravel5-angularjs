app.factory('users', ['$http', function ($http) {
  var path = '/api/users';
  var users = $http.get(path).then(function (resp) {
    return resp.data.users;
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