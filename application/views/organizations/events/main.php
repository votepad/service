<script type="text/javascript" src="<?=$assets; ?>static/js/organization/EventsInOrg.js"></script>
<script type="text/javascript">
    $('.header_menu-btn-icon.right').remove()
</script>

<div class="jumbotron block">

    <?=Debug::vars($organization); ?>

    <!-- Jumbotron Wrapper -->
    <?=View::factory('organizations/blocks/jumbotron_wrapper'); ?>

    <!-- Jumbotron Navigation -->
    <div class="jumbotron_nav">
        <?=$jumbotron_navigation; ?>
    </div>

</div>

