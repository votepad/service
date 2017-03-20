<button class="btn btn_primary" type="button" name="button">я сотрудник этой организации</button>
<button class="btn btn_default" type="button" name="button">Отменить заявку</button>
<button class="btn btn_default" type="button" name="button">выйти из организаци</button>
<? if($show_auth): ?>
    <script>
        $('#auth_modal').modal('show');
    </script>
<? endif; ?>
