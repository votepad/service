<!DOCTYPE html>
<html lang="ru">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <meta name="description" content="Продолжение регистрации">
   <meta name="keywords" content="ЗАПОЛНИТЬ!">
   <title>Продолжение регистрации - ProNWE.ru</title>
   <!-- =============== VENDOR STYLES ===============-->
   <!-- FONT AWESOME-->

   <? foreach($css as $styles): ?>
      <link rel="stylesheet" href="<?=$assets;?><?=$styles;?>">
   <? endforeach;?>

</head>

<body>
   <div class="wrapper">
      <header class="topnavbar-wrapper">
         <nav role="navigation" class="navbar topnavbar">
            <div class="navbar-header">
               <a href="#/" class="navbar-brand">
                  <div class="brand-logo">
                     <img src="<?=$assets; ?>img/ProNWE_logo.svg" alt="App Logo" class="img-responsive">
                  </div>
                  <div class="brand-logo-collapsed">
                     <img src="<?=$assets; ?>img/ProNWE_logo_small.svg" alt="Logo" class="img-responsive">
                  </div>
               </a>
            </div>
            <div class="nav-wrapper">
               <!-- LEFT NAVBAR -->
               <ul class="nav navbar-nav">
                  <!-- SHOW/HIDDEN ASIDE -->
                  <li>
                     <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
                     <a href="#" data-toggle-state="aside-collapsed" class="hidden-xs">
                        <em class="fa fa-navicon"></em>
                     </a>
                     <!-- Button to show/hide the sidebar on mobile. Visible on mobile only.-->
                     <a href="#" data-toggle-state="aside-toggled" data-no-persist="true" class="visible-xs sidebar-toggle">
                        <em class="fa fa-navicon"></em>
                     </a>
                  </li>
                  <!-- USER PROFILE -->
                  <li>
                     <a href="#" title="Профиль">
                        <em class="icon-user"></em>
                     </a>
                  </li>
                  <!-- FAQ -->
                  <li>
                     <a href="#" title="FAQ">
                        <em class="icon-info"></em>
                     </a>
                  </li>
               </ul>
               <!-- RIGHT NAVBAR -->
               <ul class="nav navbar-nav navbar-right" style="margin-right:0px;">
                  <!-- SEARCH ICON -->
                  <li>
                     <a href="#" data-search-open="" title="Поиск">
                        <em class="icon-magnifier"></em>
                     </a>
                  </li>

                  <!-- NOTIFICATION -->
                  <li class="dropdown dropdown-list">
                     <a href="#" data-toggle="dropdown" aria-expanded="true" title="Уведомления">
                        <em class="icon-bell"></em>
                        <div class="label label-danger">35</div>
                     </a>
                     <ul class="dropdown-menu animated flipInX">
                        <li>
                           <div class="list-group">

                              <a href="#" class="list-group-item">
                                 <div class="media-box">
                                    <div class="pull-left">
                                       <em class="fa fa-thumbs-o-up fa-2x text-danger"></em>
                                    </div>
                                    <div class="media-box-body clearfix">
                                       <p class="m0">Лайки</p>
                                       <p class="m0 text-muted">
                                          <small>20 новых лайков</small>
                                       </p>
                                    </div>
                                 </div>
                              </a>

                              <a href="#" class="list-group-item">
                                 <div class="media-box">
                                    <div class="pull-left">
                                       <em class="fa fa-comments-o fa-2x text-warning"></em>
                                    </div>
                                    <div class="media-box-body clearfix">
                                       <p class="m0">Отзывы</p>
                                       <p class="m0 text-muted">
                                          <small>У Вам 10 непрочитанных отзывов</small>
                                       </p>
                                    </div>
                                 </div>
                              </a>

                              <a href="#" class="list-group-item">
                                 <div class="media-box">
                                    <div class="pull-left">
                                       <em class="fa fa-user-plus fa-2x text-info"></em>
                                    </div>
                                    <div class="media-box-body clearfix">
                                       <p class="m0">Подписчики</p>
                                       <p class="m0 text-muted">
                                          <small>5 новых подписчиков</small>
                                       </p>
                                    </div>
                                 </div>
                              </a>
                           </div>
                        </li>
                     </ul>
                  </li>

                  <!-- TWITTER -->
                  <li class="dropdown dropdown-list">
                     <a href="#" data-toggle="dropdown" title="Твиттер">
                        <em class="icon-social-twitter"></em>
                     </a>
                     <div class="dropdown-menu twitter animated bounceInDown">
                        <a class="twitter-timeline list-group-item" height="300" data-dnt="true" href="https://twitter.com/ProNWERU" data-widget-id="700100240783896577">Твиты от @ProNWERU</a>
                     </div>
                  </li>
                  
                  <!-- LOGOUT -->
                  <li>
                     <a href="#" title="Выход">
                        <em class="icon-logout"></em>
                     </a>
                  </li>
               </ul>
            </div>

            <!-- SEARCH FORM -->
            <form role="search" action="search.html" class="navbar-form">
               <div class="form-group has-feedback">
                  <input type="text" placeholder="Введите и нажмите Enter" class="form-control">
                  <div data-search-dismiss="" class="fa fa-times form-control-feedback"></div>
               </div>
               <button type="submit" class="hidden btn btn-default">Поиск</button>
            </form>
         </nav>
      </header>
      
      <aside class="aside">
         <div class="aside-inner">
            <nav data-sidebar-anyclick-close="" class="sidebar">
               <ul class="nav">                  
                  <!-- LEFT NAVIGATION -->
                  <li class="nav-heading">
                     <span>Навигация</span>
                  </li>
                  <!--<li class=" ">
                     <a href="#organisationLink" title="Организации" data-toggle="collapse">
                        <em class="icon-briefcase"></em>
                        <span>Организации</span>
                     </a>
                     <ul id="organisationLink" class="nav sidebar-subnav collapse">
                        <li class="sidebar-subnav-header">Организации</li>
                        <li class=" ">
                           <a href="" title="Мои организации">
                              <span>Мои организации</span>
                           </a>
                        </li>
                  <li class=" ">
                           <a href="" title="Список организаций">
                              <span>Список организаций</span>
                           </a>
                        </li>
                     </ul>
                  </li>-->
                  <li class=" ">
                     <a href="#eventLink" title="Мои мероприятия" data-toggle="collapse">
                        <em class="icon-notebook"></em>
                        <span>Мои мероприятия</span>
                     </a>
                  </li>
                  <li class=" ">
                     <a href="#eventLink" title="Все мероприятия" data-toggle="collapse">
                        <em class="icon-list"></em>
                        <span>Все мероприятия</span>
                     </a>
                  </li>
                  <li class=" ">
                     <a href="" title="Создать мероприятие" data-toggle="collapse">
                        <em class="icon-plus"></em>
                        <span>Создать мероприятие</span>
                    </a>
                  </li>
               </ul>
            </nav>
         </div>
         <!-- END Sidebar (left)-->
      </aside>
      
      <!-- MAIN SECTION -->
      <section>
         <div class="content-wrapper">
            <h3>Продолжение регистрации</h3>

            <div class="panel panel-default">
               <div class="panel-heading">Заполните основную информацию о себе</div>
               <div class="panel-body">
                  <form method="post" action="<?=URL::site('signUp/save'); ?>" class="form-horizontal">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="input-surname" class="col-sm-2 control-label">Фамилия</label>
                              <div class="col-sm-10">
                                 <input id="input-surname" name="lastname" type="text" class="form-control">
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="input-name" class="col-sm-2 control-label">Имя</label>
                              <div class="col-sm-10">
                                 <input id="input-name" name="name" type="text" class="form-control">
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="input-lastname" class="col-sm-2 control-label">Отчество</label>
                              <div class="col-sm-10">
                                 <input id="input-lastname" name="surname" type="text" class="form-control">
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Пол</label>
                              <div class="col-sm-10">
                                 <label class="radio-inline c-radio">
                                    <input id="male" name="sex" type="radio" value="male" checked="">
                                       <span class="fa fa-circle"></span>Мужской
                                 </label>
                                 <label class="radio-inline c-radio">
                                    <input id="female" name="sex" type="radio" value="female">
                                       <span class="fa fa-circle"></span>Женский
                                 </label>
                              </div>
                           </div>
                        </div>
                        
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Телефон</label>
                              <div class="col-sm-10">
                                 <input id="number" type="text" name="number" data-parsley-type="number" class="form-control">
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="input-lastname" class="col-sm-2 control-label">Страна</label>
                              <div class="col-sm-10">
                                 <input id="country" name="country" type="text" class="form-control">
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="input-lastname" class="col-sm-2 control-label">Город</label>
                              <div class="col-sm-10">
                                 <input id="city" name="city" type="text" class="form-control"> 
                              </div>
                           </div>
                           <div class="col-md-6 btn_area">
                              <button type="button" id="update-photo" class="btn btn-primary">Выберите фотографию</button>
                           </div>
                           <div class="col-md-6 btn_area">
                              <button id="submit" type="submit" class="btn btn-primary">Готово</button>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </section>
      
      <!-- FOOTER -->
      <footer>
         <span>&copy; 2016 - ProNWE</span>
      </footer>
   </div>
   <!-- =============== VENDOR SCRIPTS ===============-->
   <? foreach ($js as $scripts): ?>
      <script src="<?=$assets.$scripts; ?>"></script>
   <? endforeach; ?>
   <script type="text/javascript">
      window.onload = function () {
         jQuery("#city").val(ymaps.geolocation.city);
         jQuery("#country").val(ymaps.geolocation.country);
      }
   </script> 

    <!-- START UPDATE PHOTO -->
   <div class="update-overlay" tabindex="-1"></div>
   <div class="update-alert animated" data-allow-outside-click="false" style="display:none">
      <div class="update-alert-header">
         <button type="button" class="update-alert-close">Закрыть</button>
         <h4 class="update-alert-title">Загрузка новой обложки</h4>
      </div>
      <div class="update-alert-body">
         <div id="select-photo" class="animated">
            <h5>
               Загрузите новую обложку для своей страницы мероприятия<br><br>
               Вы можете загрузить изображение в формате JPG, GIF или PNG.
            </h5>
            <br>
            <div class="row">
               <label for="inputImage" title="Выберите файл" class="btn btn-choose update-alert-choose">
               <input id="inputImage" name="file" type="file" accept="image/jpeg,image/gif,image/png" class="sr-only">
                  <span class="fa fa-upload"> Выберите файл</span>
               </label>
            </div>
            <br>
            <h5>Если у Вас возникают проблемы с загрузкой, попробуйте выбрать изобржение меньшего размера</h5>
         </div>
         
         <div id="edit-photo" class="animated" style="display: none;">
            <h5>Выбранная область будет показываться на Вашей странице.</h5>
               <br>
            <div class="img-container mb-lg" >
               <img id="photo" src="" alt="Picture" class="cropper-hidden" >
            </div>
            <div class="row">
               <div class="col-md-6 btn_area">
                  <button id="save-photo" type="button" class="btn">Сохранить</button>   
               </div>
               <div class="col-md-6 btn_area">
                  <button type="button" class="btn btn-another">Выбрать другой файл</button>
               </div>
            </div>
         </div>
      </div>
   </div>
   <script type="text/javascript">
      $("#update-photo").click(function (){
         $("#select-photo").css("display","block");
         $("#edit-photo").css("display","none");
         $(".update-overlay").css("display","block");
         $(".update-alert").removeClass("bounceOut").addClass("bounceIn").css("display","block");
      });
      $(".update-alert-close").click(function (){
         $(".update-alert").removeClass("bounceIn").addClass("bounceOut");
         $(".update-overlay").css("display","none");
      });
      $("#photo").cropper({
         mouseWheelZoom: false,
         mavable: false,      
         built: function () {
            $("#photo").cropper("setAspectRatio", 1 / 1);
         }
      });
      $('input[type=file]').on('change',function(){
         $("#select-photo").css("display","none");
         $("#edit-photo").css("display","block");
      });
      $(".btn-another").click(function(){
         $("#select-photo").css("display","block");
         $("#edit-photo").css("display","none");
      });
   </script>
   <!-- END UPDATE PHOTO -->      
</body>

</html>