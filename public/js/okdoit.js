 angular.module('okdoit',['okdoitapiservice']).
     config(['$routeProvider',function($routeProvider) {        
    $routeProvider
        .when('/about',{templateUrl:'partials/about.html',controller:aboutCtrl})
        .when('/goals',{templateUrl:'partials/goals.html',controller:goalCtrl})
        .when('/goals/:goalId',{templateUrl:'partials/goal-details.html',controller:goalDetailsCtrl})
        .when('/tasks',{templateUrl:'partials/task.html',controller:taskCtrl})
        .when('/tasks/:taskId',{templateUrl:'partials/task-details.html',controller:taskDetailsCtrl})
       .when('/tasks/add',{templateUrl:'partials/task-details.html',controller:taskDetailsCtrl})
       
       .otherwise({redirectTo:'/home',templateUrl:'partials/home.html',controller:homeCtrl});
    
    
}]);


function MainController($scope,$location){
    
    $scope.addTask=function(){
       window.location = "#/tasks/add";  
    }
    $scope.setRoute=function(route){
        $location.path(route);
    }

}

function aboutCtrl($scope){
    $scope.title="About";
    $scope.body="This is about page";
}

function goalCtrl($scope,Goal){
    $scope.title="Goal";
    $scope.body="This is goal page";
   	$scope.goals=Goal.get();
    
}
function goalDetailsCtrl($scope,$routeParams,Goal){
    $scope.title="Goal";
    $scope.body="This is goal page";
   	$scope.goal=Goal.get({goalId:$routeParams.goalId});
    
}
function taskCtrl($scope,Task){
    $scope.title="Task";
    $scope.body="This is task page";
    $scope.tasks=Task.get();
}

function taskDetailsCtrl($scope,$routeParams,Task){
    $scope.title = "Goal";
    $scope.body = "This is goal page";
    Task.get({taskId:$routeParams.taskId},function(response){
         $scope.task =response.data.task;
    });
    
    //this.task = Task.get({taskId:this.params.taskId});
    //this.task =  $scope.task.data;
// console.log( this.task);

    $scope.saveTask = function () {
         
         var post_data = $.param({title:$scope.task.title});
        	
        console.log($scope.task);
        if ($scope.task.id > 0)
           Task.update($scope.task);
        else
            Task.save($scope.task);
        window.location = "#/tasks";
    }

    this.deleteTask = function () {
        this.task.$delete({taskId:this.task.id}, function() {
            alert('Task ' + task.name + ' deleted')
            window.location = "#/tasks";
        });
    }
}
function homeCtrl($scope){
    $scope.title="Home";
    $scope.body="This is home page";
}
