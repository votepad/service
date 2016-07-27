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


var app = angular.module('pronwe', ["ngAria","ngAnimate", "ngMask", "ngMaterial","720kb.socialshare"]);
app.constant("url","http://pronwe/");
app.controller("appCtrl", function(){

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
});
app.controller("orgInfoCtrl", function($scope){
  $scope.org = {id: "1", name:"Университет ИТМО", link:"http://ifmo.ru", avatar: "bg4.jpg", background: "bg2.jpg"};
});
app.controller("eventsCtrl", function($timeout, $mdSidenav, $log, url){
  this.eventInfo = events;
  this.search = {};
  this.sortparam = [{id: "name", name: "Название мероприятия"},{id: "startdata", name: "Дата начала мероприятия"}];
  this.typeparam = [{id: "", name: "Все"},{id: "1", name: "Черновик"},{id: "2", name: "Виден всем"},{id: "3", name: "Виден команде"}];
});
app.controller("teamCtrl", function(){
  this.teamInfo = team;
});
app.controller("logCtrl", function(){
  this.logInfo = logactivites;
  this.logDesc = logdescription;
});
app.controller("organizationCtrl", function(){
  this.RUtoEN = function(sim){
    
  };
});



app.filter('eventType', function () {
  return function (item) {
    if (item == 1 ) {return "Черновик"};
    if (item == 2 ) {return "Виден всем"};
    if (item == 3 ) {return "Виден команде"};
  };
});
app.filter('eventRating', function () {
  return function (item) {
    if (item == 0 ) {return "none"};
    if (item == 1 ) {return "block"};
  };
});
app.filter('countEvent', function () {
  return function (item) {
    if (events.length == 0 ) {return "К сожалению, у Вас нет мероприятий. Чтобы добавить мероприятие воспользуйтесь быстры стартом."};
    if (item == 0 ) {return "Поиск не дал результатов. Попробуйте изменить запрос."};
    if (events.length == 1 ) {return "Показано "+item+" из "+events.length+" мероприятия"};
    if (events.length > 1 ) {return "Показано "+item+" из "+events.length+" мероприятий"};
  };
});
app.filter('getTypeofLog', function () {
  return function (item) {
    return logdescription[item-1].color;
  }
});
app.filter('getLogAction', function () {
  return function (item) {
    return logdescription[item-1].action;
  }
});
app.filter('eventName', function () {
  return function (item) {
    for (var i=0; i < events.length; i++){
      if (events[i].id == item) {return events[i].name}; 
    }
  }
});
app.filter('eventLink', function () {
  return function (item) {
    for (var i=0; i < events.length; i++){
      if (events[i].id == item) {return events[i].link}; 
    }
  }
});
app.filter('userName', function () {
  return function (item) {
    for (var i=0; i < team.length; i++){
      if (team[i].id == item) {return team[i].name}; 
    }
  }
});
app.filter('toEnglish', function () {
  return function (item) {
    return translateEntoRu(item);
  }
});

var translateEntoRu = function(str){
  var replacer = {"а":"a","б":"b","в":"v","г":"g","д":"d","е":"e","ё":"e","ж":"zh","з":"z","и":"i","й":"y","к":"k","л":"l","м":"m","н":"n","о":"o","п":"p","р":"r","с":"s","т":"t","у":"u","ф":"f","х":"kh","ц":"ts","ч":"ch","щ":"shch","ъ":"ie","ы":"y","ь":"'","э":"e","ю":"iu","я":"ya"};
  var temp = str;
  if (str != undefined) {
    alert( replacer [ str[i] ])
    alert(2);
    return temp;
    
  }
  
};


var events = [
  { id: "1", 
    name: "ФедеральныйФедеральный конкурс Ты нужен людям", 
    shortdescription: "Этот конкурс проходит ежегодно, чтобы развивать креативное мышление у молодого поколения, а так же знакомить с различными социальными делами",
    startdata: "2017-05-27T14:00:00", 
    logo: "bg2.jpg", 
    type: "1", // 1 - черновик, 2 - виден всем, 3 - виден команде
    link: "tnl", 
    hashtags: "#tnl#ifmo#pronwe",
    rating: "1", // 0 - нет страницы рейтинга, 1 - есть страница рейтинга
    views: "245", 
    likes: "10"
  },
  { id: "2",
    name: "мисс итмо", 
    shortdescription: "Этот конкурс проходит ежегодно, чтобы девушки показали себя",
    startdata: "2017-04-27T14:00:00",
    logo: "bg1.jpg",
    type: "2", // 1 - черновик, 2 - виден всем, 3 - виден команде
    link: "missitmo",
    hashtags: "#missitmo#ifmo#pronwe",
    rating: "0", // 0 - нет страницы рейтинга, 1 - есть страница рейтинга
    views: "545",
    likes: "50"
  },
  { id: "3",
    name: "Мистер ИТМО", 
    shortdescription: "Этот конкурс проходит ежегодно, чтобы мужики показали себя",
    startdata: "2017-01-30T14:00:00",
    logo: "bg3.jpg",
    type: "3", // 1 - черновик, 2 - виден всем, 3 - виден команде
    link: "misteritmo",
    hashtags: "#misteritmo#ifmo#pronwe",
    rating: "1", // 0 - нет страницы рейтинга, 1 - есть страница рейтинга
    views: "175",
    likes: "150"
  },
];

var team = [
  {id: "1", name: "Иван Иванов", position: "основатель организации", avatar: "02.jpg"},
  {id: "2", name: "Екатерина Иванова", position: "модератор", avatar: "01.jpg"},
];

var logactivites = [
  // type:: 1-новые мероприятия (красный), 2 - измененные мероприятия(синий)
  {id: "1", iduser: "1", idevent: "2", date: "2016-04-27T15:00:00", type: "1"},
  {id: "2", iduser: "2", idevent: "2", date: "2016-04-26T12:00:00", type: "2"},
  {id: "3", iduser: "1", idevent: "1", date: "2016-04-25T12:00:00", type: "1"},
  {id: "4", iduser: "1", idevent: "1", date: "2016-05-27T12:00:00", type: "2"},
  {id: "5", iduser: "2", idevent: "2", date: "2016-02-20T12:00:00", type: "1"},
];
var logdescription = [
  // id == type
  {id:"1", name: "Новое мероприятие", color: "blue", action: "создал(а) новое мероприятие"},
  {id:"2", name: "Измененное мероприятие", color: "red", action: "изменил мероприятие"},
];
