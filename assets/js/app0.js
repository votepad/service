var app = angular.module('pronwe', ["ngAria","ngAnimate","ngSanitize","ngMaterial","ngRoute","720kb.socialshare"]);
app.constant("url","http://pronwe/");

// если пользователь авторизирован, то status = 1
// curOrg - выбранная органзация в масиве organizations
var status = 1;
var curOrg = 0;


app.controller("appCtrl", ['$scope', function($scope){

}]);

app.directive("topnav", function () {
  return {
     restrict: 'E',
     templateUrl: 'views/topnav/topnav.html'
  };
});
app.directive("topnavleft", function () {
  return {
     restrict: 'E',
     templateUrl: 'views/topnav/topnavleft.html',
     controller:function() {
       this.orgs = organizations;
       if (status == 1) {
         this.curOrg = organizations[curOrg];
         this.hidden = false;
       }
       else {
         this.curOrg = {name:"Создать организацию", pronwelink: "#/org/add"},
         this.hidden = true;
       }
     },
     controllerAs: 'Orgslist'
  };
});
app.directive("topnavright", function () {
  return {
     restrict: 'E',
     templateUrl: 'views/topnav/topnavright.html',
     controller: function (url) {
       this.hidden = false;
       this.isOpen = false;
       this.hover = false;
       if (status == 1){
         this.items = [
           { name: "Выйти из системы", icon: url+"assets/img/icons/exit.svg", direction: "bottom", link: "", class: "md-fab md-raised md-mini" },
           { name: "Настройки профиля", icon: url+"assets/img/icons/user-tie.svg", direction: "botton", link: "", class: "md-fab md-raised md-minimd-fab md-raised md-mini" },
           { name: "Помощь", icon: url+"assets/img/icons/info.svg", direction: "bottom", link: "", class:"md-fab md-raised md-mini" },
           { name: "Редактировать страницу организации", icon: url+"assets/img/icons/cogs.svg", direction: "bottom", link: "#/org/edit", class:"md-fab md-raised md-mini setting-sm" }
        ];
        this.avatar = user.avatar;
       }
       else {
         this.items = [
           { name: "Авторизоваться", icon: url+"assets/img/icons/enter.svg", direction: "bottom", link: "", class:"md-fab md-raised md-mini" },
           { name: "Помощь", icon: url+"assets/img/icons/info.svg", direction: "bottom", link: "", class:"md-fab md-raised md-mini" }
         ];
         this.avatar = "no-user.png";
       }
     },
     controllerAs: 'user'
  };
});
app.directive("eventsinorganization", function () {
  return {
    restrict: 'E',
    templateUrl: 'views/org/eventsinorganization.html',
    controller: 'CurentOrganizationCtrl'
  };
});
app.directive("organizationcolumn", function () {
  return {
    restrict: 'E',
    templateUrl: "views/org/organizationcolumn.html",
    controller: "CurentOrganizationCtrl"
  };
});
app.directive("searcheventinorganization", function () {
  return {
    restrict: 'E',
    templateUrl: 'views/org/searcheventinorganization.html',
    controller: 'CurentOrganizationCtrl'
  };
});
app.directive("organizationlinks", function () {
  return {
    restrict: 'E',
    templateUrl: 'views/org/organizationlinks.html',
    controller: 'CurentOrganizationCtrl'
  };
});

app.controller("CurentOrganizationCtrl", function($location, url){
  this.info = organizations[curOrg];
  this.eventInfo = events;
  this.settings = { name: "Редактировать страницу организации", icon: url+"assets/img/icons/cogs.svg", direction: "top", link: "#/org/edit", class:"md-icon-button setting-lg" }
  this.OrganizationDescriprion = organizations[curOrg].description;
  if (status == 1) { this.HiddenEdit = false; } else { this.HiddenEdit = true; }
  this.search = {};
  this.searchFilter = [{id: "name", name: "Название мероприятия"},{id: "start", name: "Дата начала мероприятия"},{id: "publishedDate", name: "Дата публикации"}];
});
app.directive("share", function () {
  return {
    restrict: 'E',
    templateUrl: 'views/share.html',
    controller: 'ShareCtrl'
  }
});
app.controller("ShareCtrl", function (url) {
  this.array =[
    {id:"vk", name:"Вконтакте", icon: url + "assets/img/icons/vk.svg"},
    {id:"facebook", name:"FaceBook", icon: url + "assets/img/icons/facebook.svg"},
    {id:"twitter", name:"Twitter", icon: url + "assets/img/icons/twitter.svg"},
  ];
});

app.controller("EventLikesCtrl", function ($scope) {
  $scope.addClass = false;
  $scope.addLikes = function (eventID) {
    $scope.addClass = $scope.addClass == false ? true:false;
  };
  $scope.showLikes = function(val){
    if (val == 0) {
      return "Мне нравиться";
    }
    if (val == 1) {
      return "Понравилось " + val + " человеку";
    }
    else {
      return "Понравилось " + val + " людям";
    }
  }
});

app.config(function ($routeProvider) {
  $routeProvider.when("/org/add", {
    templateUrl: "views/org/addOrganization.html"
  });
  $routeProvider.when("/org/edit", {
    templateUrl: "views/org/editOrganization.html"
  });
  $routeProvider.when("/org", {
    templateUrl: "views/org/organization.html"
  });
  $routeProvider.when("/event/add", {
    templateUrl: "views/event/addEvent.html"
  });
  $routeProvider.when("/event/edit", {
    templateUrl: "views/event/editEvent.html"
  });
  $routeProvider.when("/event/", {
    templateUrl: "views/event/event.html"
  });
  $routeProvider.otherwise({
    templateUrl: "views/org/organization.html"
  });
});

// информация о пользователе
var user = {name: "", avatar:"01.jpg"};

// информация об организациях конкретного пользователя
var organizations = [
  {id: "itmo", name: "ИТМО", logo:"itmo.jpg", pronwelink: "", description: "<div class='organization-description'><p><b>Основан</b> - ....<p><p><b>Факультеты: </b>ИТИП ФЛИСИ КТУ и др.</p> <p>Вся колонка вставляется через HTML текст - поключим редактор</p><p>Для организации можно изменить: <ul class='text-left'><li>background-color</li><li>font-style</li><li>color</li></ul></p></div>", style: {background: "#fff", font: "Times New Roman", color: "#000"}},
  {id: "profkom-itmo", name: "профком ИТМО", logo:"", pronwelink: "", description: "тут описание организации в виде html", style: {background: "#656565", font: "Times New Roman", color: "#000"}},
  {id: "so-itmo", name: "СО ИТМО", logo:"", pronwelink: "", description: "тут описание организации  в виде html", style: {background: "#454545", font: "Times New Roman", coloe: "#fff"}}
];

// информация об мероприятиях конкретной организации
var events = [
  {id: "missitmo", name: "Мисс ИТМО", start: "2016-05-15 17:15:00", end: "2016-05-15 20:00:00", publishedDate: "2016-05-15 17:10:00", logo: "bg1.jpg", adress:"адрес 1", likes: "1"},
  {id: "misteritmo", name: "Мистер ИТМО", start: "2016-04-13 12:00:00", end: "2016-04-15 15:00:00", publishedDate: "2016-05-15 17:11:00", logo: "bg2.jpg", adress:"адрес 2", likes: "40"},
  {id: "tnl", name: "Ты Нужен Людям", start: "2016-05-15 18:00:00", end: "2016-06-15 18:00:00", publishedDate: "2016-05-15 17:12:00", logo: "bg3.jpg", adress:"адрес 3", likes: "20"},
  {id: "spring", name: "Весна в ИТМО", start: "2016-05-26 17:00:00", end: "2016-05-27 19:00:00", publishedDate: "2016-05-15 17:13:00", logo: "bg4.jpg", adress:"адрес 4", likes: "50"}
];
// перевод даты в нужный формат
for (var i = 0; i < events.length; i++) {
  events[i].start = new Date(events[i].start);
  events[i].end = new Date(events[i].end);
  events[i].publishedDate = new Date(events[i].publishedDate);
}
