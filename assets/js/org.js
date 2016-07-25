$(function () {
  $('[data-toggle="tooltip"]').tooltip({
    template: '<div class="tooltip" role="tooltip"><div class="tooltip-inner"></div></div>'
  });


  $('.vk').hover(function(){$('.vk md-icon').css("color","#4c75a3");}, function(){$('.vk md-icon').css("color","#656565");});
  $('.facebook').hover(function(){$('.facebook md-icon').css("color","#3b5998");}, function(){$('.facebook md-icon').css("color","#656565");});
  $('.twitter').hover(function(){$('.twitter md-icon').css("color","#35b0ed");}, function(){$('.twitter md-icon').css("color","#656565");});
  /* add likes */
  $('.fav').on('click', function(){
    if ( $("md-icon", this).hasClass('active') ) {
      $("md-icon", this).removeClass('active');
    }
    else {
      $("md-icon", this).addClass('active');
    }
  });

});


/* ANGULAR */


var app = angular.module('pronwe', ["ngAria","ngAnimate","ngMaterial","720kb.socialshare"]);

app.constant("url","http://pronwe/");

app.controller("appCtrl", function(){

});



app.directive("topnav", function () {
  return {
     restrict: 'E',
     templateUrl: 'orgpage/topnav.html'
  };
});

app.directive("orginfo", function () {
  return {
    restrict: 'E',
    templateUrl: 'orgpage/orginfo.html',
    controller: 'orgInfoCtrl'
  };
});
app.controller("orgInfoCtrl", function($scope){
  $scope.org = {id: "1", name:"Университет ИТМО", link:"http://ifmo.ru", avatar: "bg4.jpg", background: "bg2.jpg"};
});

app.directive("events", function () {
  return {
    restrict: 'E',
    templateUrl: 'orgpage/events.html',
    controller: 'eventsCtrl'
  };
});
app.controller("", function($scope){
  $scope.org = {id: "1", name:"Университет ИТМО", link:"http://ifmo.ru", avatar: "bg4.jpg", background: "bg2.jpg"};
});

app.directive("share", function () {
  return {
    restrict: 'E',
    templateUrl: 'orgpage/share.html',
    controller: 'ShareCtrl'
  }
});
app.controller("ShareCtrl", function (url) {
  this.array =[
    {id:"vk", name:"Вконтакте", icon: url + "assets/img/icons/vk.svg", class:"vk"},
    {id:"facebook", name:"FaceBook", icon: url + "assets/img/icons/facebook.svg", class:"facebook"},
    {id:"twitter", name:"Twitter", icon: url + "assets/img/icons/twitter.svg", class:"twitter"},
  ];
})