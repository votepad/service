<div class="block" >

    <ul class="tabs__header">

        <li class="col-xs-12 col-md-6 text-center">
            <a data-toggle="tabs" data-block="myOrganizations" data-search="myOrganizationsSearch" class="tabs__btn tabs__btn--active fl_n">
                <? if ($isProfileOwner) : ?>Мои организации <? else : ?> Организации <? endif; ?>
                <span id="myOrganizationsCounter" class="tabs__count">1</span>
            </a>
        </li>

        <li class="col-xs-12 col-md-6 text-center">
            <a data-toggle="tabs" data-block="myEvents" data-search="myEventsSearch" class="tabs__btn fl_n">
                <? if ($isProfileOwner) : ?>Мои мероприятия <? else : ?> Мероприятия <? endif; ?>
                <span id="myEventsCounter" class="tabs__count">1</span>
            </a>
        </li>

    </ul>

    <div class="tabs__search">

        <div id="myOrganizationsSearch" class="tabs__search-block tabs__search-block--active">
            <input id="myOrganizationsSearchInput" type="text" class="tabs__search-input" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" placeholder="Начните вводить название организации">
            <label for="myOrganizationsSearchInput" class="fa fa-search tabs__search-label" aria-hidden="true"></label>
        </div>

        <div id="myEventsSearch" class="tabs__search-block">
            <input id="myEventsSearchInput" type="text" class="tabs__search-input" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" placeholder="Начните вводить названия мероприятия">
            <label for="myEventsSearchInput" class="fa fa-search tabs__search-label" aria-hidden="true"></label>
        </div>
        
    </div>

    <div class="tabs__content clear_fix">

        <div id="myOrganizations" class="tabs__block tabs__block--active">

            <? foreach ($organizations as $organization) : ?>
                <? if ($organization->id) : ?>
                    <div id="organization_organization-><?=$organization->id; ?>" class="item col-xs-12 col-md-6">
                        <a href="<?= URL::site( 'organization/' . $organization->id ); ?>" class="item__img-wrap">
                            <img class="item__img" alt="Org img" src="/uploads/organization/logo/<?=$organization->logo; ?>">
                        </a>
                        <div class="item__info">
                            <div class="item__info-name">
                                <a href="<?= URL::site( 'organization/' . $organization->id ); ?>"><?=$organization->name; ?></a>
                            </div>
                            <div class="item__info-additional">
                                <a href="<?= URL::site( 'organization/' . $organization->id ); ?>"><?=$isProfileOwner ? 'Основатель' : 'Сотрудник'; ?></a>
                            </div>
                            <? if (!$isProfileOwner) : ?>
                            <div class="item__info-controls clear_fix">
                                <button data-id="organization->id" data-name="organization->name" class="btn btn_default deleteOrganization">Выйти из организации</button>
                            </div>
                            <? endif; ?>
                        </div>
                    </div>
                <? endif; ?>
            <? endforeach; ?>

        </div>


        <div id="myEvents" class="tabs__block">

            <div id="event_event->id" class="item col-xs-12 col-md-6">
                <a href="" class="item__img-wrap">
                    <img class="item__img" alt="Event cover" src="">
                </a>
                <div class="item__info">
                    <div class="item__info-name">
                        <a href="<?= URL::site(''); ?>">Event name</a>
                    </div>
                    <div class="item__info-additional">
                        <a href="">Над мероприятием работают 5 организатор(ов)</a>
                    </div>
                    <? if ($isProfileOwner) : ?>
                    <div class="item__info-controls clear_fix">
                        <button data-id="event->id" data-name="event->name" class="btn btn_default deleteEvent">Покинуть мероприятия</button>
                    </div>
                    <? endif; ?>
                </div>
            </div>

        </div>

    </div>
</div>
