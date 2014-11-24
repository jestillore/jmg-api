function baseUrl(url) {
	return 'http://zoogtech.com/jmg/public' + url;
}
var jmg = angular.module('JMG', ['ui.router', 'ngResource', 'angularFileUpload']);
jmg.config(['$stateProvider', '$urlRouterProvider', '$interpolateProvider', '$resourceProvider', function ($stateProvider, $urlRouterProvider, $interpolateProvider, $resourceProvider) {
	// $resourceProvider.defaults.stripTrailingSlashes = false;
	$interpolateProvider.startSymbol('{[').endSymbol(']}');
	$urlRouterProvider.otherwise("/jobs/all");
	$stateProvider.state('addcompany', {
		url: '/add-company',
		templateUrl: 'partials/add-company.html',
		controller: 'CompanyController'
	}).state('companydone', {
		url: '/companydone/:id',
		templateUrl: 'partials/add-company-done.html',
		controller: ['$scope', '$stateParams', 'Companies', function ($scope, $stateParams, Companies) {
			$scope.company = Companies.get({
				id: $stateParams.id
			});
		}]
	}).state('company', {
		url: '/company/:id',
		templateUrl: 'partials/company.html',
		controller: ['$scope', '$stateParams', 'Companies', function ($scope, $stateParams, Companies) {
			$scope.company = Companies.get({
				id: $stateParams.id
			});
		}]
	}).state('addjob', {
		url: '/add-job/:companyId',
		templateUrl: 'partials/add-job.html',
		controller: 'JobsController'
	}).state('jobs', {
		url: '/jobs',
		templateUrl: 'partials/jobs.html'
	}).state('jobs.all', {
		url: '/all',
		templateUrl: 'partials/all-jobs.html',
		controller: ['$scope', 'Jobs', function ($scope, Jobs) {
			$scope.jobs = Jobs.query();
		}]
	}).state('jobs.urgent', {
		url: '/urgent',
		templateUrl: 'partials/all-jobs.html',
		controller: ['$scope', 'Jobs', function ($scope, Jobs) {
			$scope.jobs = Jobs.urgent();
		}]
	}).state('jobs.pooling', {
		url: '/pooling',
		templateUrl: 'partials/all-jobs.html',
		controller: ['$scope', 'Jobs', function ($scope, Jobs) {
			$scope.jobs = Jobs.pooling();
		}]
	}).state('jobs.deployment', {
		url: '/deployment',
		templateUrl: 'partials/all-jobs.html',
		controller: ['$scope', 'Jobs', function ($scope, Jobs) {
			$scope.jobs = Jobs.deployment();
		}]
	}).state('jobdone', {
		url: '/jobdone/:id',
		templateUrl: 'partials/add-job-done.html',
		controller: ['$scope', '$stateParams', 'Jobs', function ($scope, $stateParams, Jobs) {
			$scope.job = Jobs.get({
				id: $stateParams.id
			});
		}]
	}).state('job', {
		url: '/job/:id',
		templateUrl: 'partials/job.html',
		controller: ['$scope', '$stateParams', 'Jobs', function ($scope, $stateParams, Jobs) {
			var job = Jobs.get({
				id: $stateParams.id
			});
			$scope.job = job;
		}]
	});
}]);
jmg.factory('Ranks', ['$resource', function ($resource) {
	return $resource(baseUrl('/ranks/:id'));
}]);
jmg.factory('Departments', ['$resource', function ($resource) {
	return $resource(baseUrl('/departments/:id'));
}]);
jmg.factory('Vessels', ['$resource', function ($resource) {
	return $resource(baseUrl('/vessels/:id'));
}]);
jmg.factory('Companies', ['$resource', function ($resource) {
	return $resource(baseUrl('/company/:id'));
}]);
jmg.factory('Jobs', ['$resource', function ($resource) {
	return $resource(baseUrl('/jobs/:id'), null, {
		urgent: {
			method: 'GET',
			isArray: true,
			params: {
				category: 'urgent'
			}
		},
		pooling: {
			method: 'GET',
			isArray: true,
			params: {
				category: 'pooling'
			}
		},
		deployment: {
			method: 'GET',
			isArray: true,
			params: {
				category: 'regular'
			}
		}
	});
}]);
jmg.factory('User', ['$resource', function ($resource) {
	return $resource(baseUrl('/user'));
}]);
jmg.factory('VesselFlags', ['$resource', function ($resource) {
	return $resource(baseUrl('/vessel-flags/:id'));
}]);
jmg.factory('TradeRoutes', ['$resource', function ($resource) {
	return $resource(baseUrl('/trade-routes/:id'));
}]);
jmg.directive('jobs', function () {
	return {
		restrict: 'E',
		templateUrl: 'templates/job-list.html'
	};
});
jmg.controller('CompanyController', ['$scope', '$state', 'Companies', '$upload', function ($scope, $state, Companies, $upload) {
	function pad(num, size) {
	    var s = '0' + num;
	    return s.substr(s.length - size);
	}
	$scope.months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
	$scope.dates = [];
	$scope.years = [];
	for(var x = 1; x <= 31; x++) {
		$scope.dates.push(pad(x, 2));
	}
	var date = new Date();
	for(var x = date.getFullYear(); x <= (date.getFullYear() + 5); x++) {
		$scope.years.push(x);
	}
	$scope.addCompany = function () {
		// var company = new Companies({
			// name: $scope.name,
			// poea: $scope.poea,
			// validity: $scope.validityY + '-' + $scope.validityM + '-' + $scope.validityD,
			// address: $scope.address,
			// telephone: $scope.telephone,
			// fax: $scope.fax,
			// website: $scope.website,
			// cp_firstname: $scope.contactFirstname,
			// cp_lastname: $scope.contactLastname,
			// cp_designation: $scope.contactDesignation,
			// cp_email: $scope.contactEmail,
			// cp_telephone: $scope.contactTelephone,
			// cp_fax: $scope.contactFax
		// });
		// company.$save(function () {
		// 	console.log(company.id);
		// 	$state.go('companydone', {
		// 		id: company.id
		// 	});
		// });
		$scope.upload = $upload.upload({
	        url: baseUrl('/company'), //upload.php script, node.js route, or servlet url
	        method: 'POST',
	        //headers: {'header-key': 'header-value'},
	        //withCredentials: true,
	        data: {
	        	name: $scope.name,
				poea: $scope.poea,
				validity: $scope.validityY + '-' + $scope.validityM + '-' + $scope.validityD,
				address: $scope.address,
				telephone: $scope.telephone,
				fax: $scope.fax,
				website: $scope.website,
				cp_firstname: $scope.contactFirstname,
				cp_lastname: $scope.contactLastname,
				cp_designation: $scope.contactDesignation,
				cp_email: $scope.contactEmail,
				cp_telephone: $scope.contactTelephone,
				cp_fax: $scope.contactFax
	        },
	        file: $scope.file, // or list of files ($files) for html5 only
	        //fileName: 'doc.jpg' or ['1.jpg', '2.jpg', ...] // to modify the name of the file(s)
	        // customize file formData name ('Content-Disposition'), server side file variable name. 
	        //fileFormDataName: myFile, //or a list of names for multiple files (html5). Default is 'file' 
	        // customize how data is added to formData. See #40#issuecomment-28612000 for sample code
	        //formDataAppender: function(formData, key, val){}
	    }).progress(function(evt) {
	    	console.log('percent: ' + parseInt(100.0 * evt.loaded / evt.total));
	    }).success(function(company, status, headers, config) {
        	$state.go('companydone', {
				id: company.id
			});
      	});
	};

	$scope.onFileSelect = function (files) {
		$scope.file = files[0];
	};
}]);
jmg.controller('JobsController', ['$scope', '$state', '$stateParams', 'Ranks', 'Departments', 'Vessels', 'Companies', 'VesselFlags', 'TradeRoutes', 'Jobs', function ($scope, $state, $stateParams, Ranks, Departments, Vessels, Companies, VesselFlags, TradeRoutes, Jobs) {
	function pad(num, size) {
	    var s = '0' + num;
	    return s.substr(s.length - size);
	}
	$scope.months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
	$scope.dates = [];
	$scope.years = [];
	for(var x = 1; x <= 31; x++) {
		$scope.dates.push(pad(x, 2));
	}

	var date = new Date();
	for(var x = date.getFullYear(); x <= (date.getFullYear() + 5); x++) {
		$scope.years.push(x);
	}

	$scope.ranks = Ranks.query();
	$scope.vessels = Vessels.query();
	$scope.departments = Departments.query();
	$scope.companies = Companies.query();
	$scope.vesselFlags = VesselFlags.query();
	$scope.tradeRoutes = TradeRoutes.query();

	/* init value */
	$scope.category = 'urgent';

	if($stateParams.companyId) {
		var company = Companies.get({
			id: $stateParams.companyId
		});
	}

	$scope.addJob = function () {
		var job = new Jobs({
			company_id: $scope.companyOwner() ? $scope.user.company.id : $scope.company,
			category: $scope.category,
			rank_id: $scope.rank,
			department_id: $scope.department,
			vessel_id: $scope.vessel,
			slots: $scope.slots,
			vessel_flag_id: $scope.vesselFlag,
			post_start: $scope.startYear + '-' + $scope.startMonth + '-' + $scope.startDate,
			post_end: $scope.endYear + '-' + $scope.endMonth + '-' + $scope.endDate,
			trade_route_id: $scope.tradeRoute,
			description: $scope.description
		});
		job.$save(function () {
			$state.go('jobdone', {
				id: job.id
			});
		});
	};
}]);
jmg.controller('UserController', ['$scope', 'User', function ($scope, User) {
	$scope.user = User.get({});
	$scope.superUser = function () {
		return $scope.user.role == 1;
	};
	$scope.companyOwner = function () {
		return $scope.user.role == 2;
	};
}]);
