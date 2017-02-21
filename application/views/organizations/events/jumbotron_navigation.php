<?
    $owner      = Model_PrivillegedUser::getUserOrganization(Session::instance()->get('id_user')) == $id;
    $isLogged   = Dispatch::isLogged();
    $allowed    = $isLogged && $owner;
?>

<script type="text/javascript" src="<?=$assets; ?>js/organizations/EventsInOrg.js"></script>

<!-- Searching event on loaded page -->
<div class="jumbotron_nav-searching-block">

    <div class="jumbotron_nav-searching-select-wrapper">
        <div id="" role="button" class="jumbotron_nav-searching-select-icon">
            <i class="fa fa-sort" aria-hidden="true"></i>
        </div>
        <div class="jumbotron_nav-searching-select-dropdown-menu">
            <a class="jumbotron_nav-searching-select-dropdown-item">
                Название мероприятия
            </a>
            <a class="jumbotron_nav-searching-select-dropdown-item">
                Дата начала мероприятия
            </a>
        </div>
    </div>
<? if ( $allowed ): ?>
    <div class="jumbotron_nav-searching-select-wrapper">
        <div id="" role="button" class="jumbotron_nav-searching-select-icon">
            <i class="fa fa-filter" aria-hidden="true"></i>
        </div>
        <div class="jumbotron_nav-searching-select-dropdown-menu">
            <a class="jumbotron_nav-searching-select-dropdown-item">
                Черновик
            </a>
            <a class="jumbotron_nav-searching-select-dropdown-item">
                Виден всем
            </a>
        </div>
    </div>
<? endif; ?>



    <!--<div class="jumbotron_nav-searching-select-wrapper">
        <select name="event_sort" class="select_btn">
            <option value="0" data-btn='<i class="fa fa-sort" aria-hidden="true"></i>' data-text="" data-class="active"></option>
            <option value="1" data-text="Название мероприятия" data-class="">Название мероприятия</option>
            <option value="2" data-text="Дата начала мероприятия" data-class="">Дата начала мероприятия</option>
        </select>
    </div>

    <div class="jumbotron_nav-searching-select-wrapper">
        <select name="event_type" class="select_btn">
            <option value="0" data-btn='<i class="fa fa-filter" aria-hidden="true"></i>' data-text="" data-class="active"></option>
            <option value="1" data-text="черновик" data-class="">черновик</option>
            <option value="2" data-text="виден всем" data-class="">виден всем</option>
            <option value="3" data-text="виден команде" data-class="">виден команде</option>
        </select>
    </div>-->

    <input name="event_name" type="text" class="jumbotron_nav-searching-input" placeholder="Поиск мероприятия">
</div>






<!--<div class="block block-default searching">
    <div class="block-body">
        <ul class="ls_none clearfix">
            <li class="inlineblock">
                Поиск мероприятия
            </li>


      <div class="inlineblock fl_l select_wrapper">
        <select name="event_sort" class="select_btn">
          <option value="0" data-btn='<i class="fa fa-sort" aria-hidden="true"></i>' data-text="" data-class="active"></option>
          <option value="1" data-text="Название мероприятия" data-class="">Название мероприятия</option>
          <option value="2" data-text="Дата начала мероприятия" data-class="">Дата начала мероприятия</option>
        </select>
      </div>

      <div class="inlineblock fl_l select_wrapper">
        <select name="event_type" class="select_btn">
          <option value="0" data-btn='<i class="fa fa-filter" aria-hidden="true"></i>' data-text="" data-class="active"></option>
          <option value="1" data-text="черновик" data-class="">черновик</option>
          <option value="2" data-text="виден всем" data-class="">виден всем</option>
          <option value="3" data-text="виден команде" data-class="">виден команде</option>
        </select>
      </div>
            </li>
        </ul>
    </div>
</div>
-->
