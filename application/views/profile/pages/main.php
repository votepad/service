
<div class="block" >

    <ul class="tabs__header">

        <li class="">
            <a data-toggle="tabs" data-area="coworkers" class="tabs__btn tabs__btn--active">Состоят в организации
                <span id="" class="tabs__count">56</span>
            </a>
        </li>

        <li class="">
            <a data-toggle="tabs" data-area="newCoworkers" class="tabs__btn">Новые заявки
                <span class="tabs__count">89</span>
            </a>
        </li>

        <button data-href="http://votepad.ru/organization/= $organization->id ?>" id="inviteBtn" class="tabs__btn btn btn_primary fl_r">Пригласить</button>

    </ul>

    <div class="tabs__content clear_fix">

        <div id="coworkers" class="tabs__block tabs__block--active">

            <div id="item_id" class="item col-xs-12 col-md-6">
                <a href="" class="item__img-wrap">
                    <img class="item__img" alt="item img" src="">
                </a>
                <div class="item__info">
                    <div class="item__info-name">
                        <a href="/user/= $member->id; ?>">= $member->surname . ' ' . $member->name . ' ' . $member->lastname; ?></a>
                    </div>
                    <div class="item__info-additional">
                        <a href="">= $member->email; ?></a>
                        <a href="">= $member->phone; ?></a>
                    </div>
                    <div class="item__info-controls clear_fix">
                        <button data-id="= $member->id; ?>" data-name="= $member->surname . ' ' . $member->name; ?>" class="btn btn_default deletebtn">Исключить</button>
                    </div>
                </div>
            </div>
        </div>


        <div id="newCoworkers" class="tabs__block">

                <div id="coworker_id= $request->id; ?>" class="coworker_row col-xs-12 col-md-6">
                    <div class="coworker_photo_wrap">
                        <a class="coworker_photo" href="">
                            <img class="coworker_photo_img" alt="Co-worker" src="">
                        </a>
                    </div>
                    <div class="coworker_info">
                        <div class="coworker_field coworker_field-title">
                            <a href="/user/= $request->id; ?>">= $request->surname . ' ' . $request->name . ' ' . $request->lastname; ?></a>
                        </div>
                        <div class="coworker_field coworker_field-contact">
                            <span>= $request->email; ?></span>
                            <span>= $request->phone; ?></span>
                        </div>
                        <div class="coworker_controls clear_fix">
                            <button data-id="" class="btn btn_primary acceptbtn">Принять заявку</button>
                            <button data-id="" class="btn btn_text cancelbtn">Отклонить</button>
                        </div>
                    </div>
                </div>
        </div>

    </div>
</div>
