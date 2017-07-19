<!--  PAGE SCRIPTS  -->
<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-transition.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-collapse.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="<?=$assets; ?>js/modules/tabs.js"></script>


<div class="row">

    <h3 class="page-header">Blocks (collapse and refresh)</h3>

    <div class="row row-col">
        <div class="col-xs-12 col-md-6">
            <div class="block block_default">
                <div class="block_heading">
                    <h4>Collapse Block</h4>
                    <a data-toggle="collapse" href="#collapseExample_1" aria-expanded="true" aria-controls="collapseExample_1">
                        <i class="fa fa-minus" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="collapse in" id="collapseExample_1">
                    <div class="block_body">
                        Panel can be collapsed clicking on the icon on the top right corner
                    </div>
                    <div class="block_footer">
                        Block Footer
                    </div>
                </div>
            </div>
            <div class="block block_default">
                <div class="block_heading">
                    <h4>Collapse Block</h4>
                    <a data-toggle="collapse" href="#collapseExample_2" aria-expanded="false" aria-controls="collapseExample_2">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="collapse" id="collapseExample_2">
                    <div class="block_body">
                        Panel can be collapsed clicking on the icon on the top right corner
                    </div>
                    <div class="block_footer">
                        Block Footer
                    </div>
                </div>
            </div>
            <div class="block block_default">
                <div class="block_heading">
                    <h4>Refresh Block</h4>
                    <a data-toggle="refresh">
                        <i class="fa fa-refresh" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="collapse in" id="collapseExample_3">
                    <div class="block_body">
                        Panel can be collapsed clicking on the icon on the top right corner
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
<blockquote>
<h4>Button</h4><p>Collapse close</p>
<xmp><a data-toggle="collapse" href="#href1" aria-expanded="false" aria-controls="href1">
    <i class="fa fa-plus" aria-hidden="true"></i>
</a></xmp><br><p>Collapse open</p>
<xmp><a data-toggle="collapse" href="#href2" aria-expanded="true" aria-controls="href2">
    <i class="fa fa-minus" aria-hidden="true"></i>
</a></xmp><br><p>Refresh</p><xmp><a data-toggle="refresh">
    <i class="fa fa-refresh" aria-hidden="true"></i>
</a></xmp><h4>Block</h4><p>Collapse close</p>
<xmp><div class="collapse" id="href1"> ... </div></xmp><br><p>Collapse open</p>
<xmp><div class="collapse in" id="href2"> ... </div></xmp>
</blockquote>
        </div>
    </div>



    <h3 class="page-header">Blocks Style</h3>

    <div class="row row-col">
        <div class="col-xs-12 col-md-6">
            <div class="block block_default">
                <div class="block_heading">
                    <h4>Default Block</h4>
                </div>
                <div class="block_body">
                    <p>
                        NWE - система информационной поддержки мероприятий, разработанная студентами нашего университета. Система предоставляет такие функции как просмотр рейтинга участников в режиме реального времени; автоматический подсчет баллов, выставленных членами жюри.
                    </p>
                </div>
                <div class="block_footer">
                    © Noteworthy Event
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
<blockquote><xmp><div class="block block_default">
<div class="block_heading">
    <h4> ... </h4>
</div>
<div class="block_body">
    ...
</div>
<div class="block_footer">
    ...
</div>
</div>
</xmp></blockquote>
        </div>
    </div>




    <h3 class="page-header">Form Example</h3>

    <div class="row row-col">
        <div class="col-xs-12 col-md-6">
                <form class="form">
                    <div class="form_heading">
                        Simple Form Template
                    </div>
                    <div class="form__body">
                        <div class="col-xs-6">
                            <div class="row">
                                <div class="input-field">
                                    <input id="example_form-0" placeholder="Enter smth">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="row">
                                <div class="input-field">
                                    <input id="example_form-1">
                                    <label for="example_form-1">Enter smth</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form__footer clear-fix">
                        <button class="btn btn_default col-xs-12 col-md-5">
                            Cancel
                        </button>
                        <button class="btn btn_primary col-xs-12 col-md-5 col-md-offset-2">
                            Save
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-xs-12 col-md-6">
<blockquote><xmp><form class="form">
    <div class="form_heading"> ... </div>
    <div class="form__body">
        <div class="col-xs-12">
            <div class="row">
                input's elements  ...
            </div>
        </div>
    </div>
    <div class="form__footer clear-fix">
        <button class="btn btn_primary col-.."> Save </button>
    </div>
</form></xmp></blockquote>
            </div>
        </div>



        <h3 class="page-header">Card Example</h3>

        <div class="row row-col">
            <div class="col-xs-12 col-md-6">
                <div class="card clear-fix">
                    <div class="card_image">
                        <img src="<?=$assets; ?>img/logo_1x1.png" alt="">
                    </div>
                    <div class="card_title">
                        <div class="card_title-text">
                            Title
                        </div>
                        <div class="card_title-dropdown">
                            <div role="button" class="card_title-dropdown-icon">
                                <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                            </div>
                            <div class="card_title-dropdown-menu">
                                <a class="card_title-dropdown-item">
                                    action 1
                                </a>
                                <a class="card_title-dropdown-item">
                                    action 2
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card_content">
                        <div class="card_content-text card_height-4em">
                            Content block Content block Content block Content block Content block
                            Content block Content block Content block Content block Content block
                            Content block Content block Content block Content block Content block
                            <div class="card_content-text-hidden"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
<blockquote><b>Template</b><xmp><div class="card clear-fix">
    <div class="card_image">
        <img src="" alt="">
    </div>
    <div class="card_title">
        <div class="card_title-text"> Title </div>
        <div class="card_title-dropdown">
            <div role="button" class="card_title-dropdown-icon">
                <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
            </div>
            <div class="card_title-dropdown-menu">
                <a class="card_title-dropdown-item"> action 1 </a>
                <a class="card_title-dropdown-item"> action 2 </a>
            </div>
        </div>
    </div>
    <div class="card_content">
        <div class="card_content-text"> Content </div>
    </div>
</div></xmp>
<br><b>Modify</b>
<xmp><div class="card_content-text card_height-4em"> ... </div> -  show text only in 4 rows</xmp>
<xmp><div class="card_content-text card_height-3em"> ... </div> -  show text only in 3 rows</xmp>
<xmp><div class="card_content-text card_height-2em"> ... </div> -  show text only in 2 rows</xmp>
<xmp><div class="card_content-text card_height-1em"> ... </div> -  show text only in 1 row</xmp>
<br>Adding hidden effect on the last line
<xmp><div class="card_content-text card_height-3em">
    ...
    <div class="card_content-text-hidden"></div>
</div></xmp></blockquote>
            </div>
        </div>




        <h3 class="page-header">Tabs</h3>

        <div class="row row-col">
            <div class="col-xs-12 col-md-6">
                <div class="block" >
                    <ul class="tabs tabs_header clear-fix">
                        <li id="">
                            <a data-ui="tabs" aria-controls="tab1" class="tab tab--active">Tab 1</a>
                        </li>
                        <li id="">
                            <a data-ui="tabs" aria-controls="tab2" class="tab">Tab 2</a>
                        </li>
                    </ul>
                    <div class="tabs_content">
                        <div id="tab1" class="tab_block tab_block--active">
                            1
                        </div>
                        <div id="tab2" class="tab_block">
                            2
                        </div>
                    </div>

                </div>

                <div class="block">
                    <ul class="tabs clear-fix">
                        <li id="">
                            <a data-ui="tabs" aria-controls="tab3" class="tab tab--active">Tab 1</a>
                        </li>
                        <li id="">
                            <a data-ui="tabs" aria-controls="tab4" class="tab">Tab 2</a>
                        </li>
                    </ul>
                    <div class="tabs_content">
                        <div id="tab3" class="tab_block tab_block--active">
                            3
                        </div>
                        <div id="tab4" class="tab_block">
                            4
                        </div>
                    </div>
                </div>

                <script type="text/javascript">
                    tabs.init()
                </script>
            </div>
            <div class="col-xs-12 col-md-6">
<blockquote><b>Template</b><xmp><div class="block" >
    <ul class="tabs clear-fix">
        <li id="">
            <a data-ui="tabs" aria-controls="tab1" class="tab tab--active">Tab 1</a>
        </li>
        <li id="">
            <a data-ui="tabs" aria-controls="tab2" class="tab">Tab 2</a>
        </li>
    </ul>
    <div class="tabs_content">
        <div id="tab1" class="tab_block active">
            1
        </div>
        <div id="tab2" class="tab_block">
            2
        </div>
    </div>
</div></xmp>
<br><b>Modify</b>
<xmp><ul class="tabs tabs_header clear-fix">
    <li id="">
        <a data-ui="tabs" aria-controls="tab1" class="tab tab--active">Tab 1</a>
    </li>
    <li id="">
        <a data-ui="tabs" aria-controls="tab2" class="tab">Tab 2</a>
    </li>
</ul></xmp>
<br><b>Script</b>
<xmp>
<script type="text/javascript" src="../tabs.js"></script>
<script type="text/javascript">
    tabs.init()
</script>
</xmp></blockquote>
            </div>
        </div>






        <h3 class="page-header">Modals</h3>


        <button type="button" class="btn btn_primary" data-toggle="modal" data-target="#Modal">
            Launch modal
        </button>
        <button type="button" class="btn btn_primary" data-toggle="modal" data-target="#smallModal">
            Launch small modal
        </button>
        <button type="button" class="btn btn_primary" data-toggle="modal" data-target="#largeModal">
            Launch large modal
        </button>

        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close" aria-hidden="true"></i></span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn_default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn_primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close" aria-hidden="true"></i></span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn_default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn_primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close" aria-hidden="true"></i></span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn_default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn_primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="row row-col">
            <div class="col-xs-12 col-md-6">

            </div>
            <div class="col-xs-12 col-md-6">
<blockquote>
Script<xmp><script type="text/javascript" src=".../vendor/bootstrap/dist/js/bootstrap-modal.js"></script></xmp><br>
Size<xmp><div class="modal-dialog     || modal-sm || modal-lg" role="document"> ... </div></xmp><br>
Link: <a class="underlinehover" href="//getbootstrap.com/javascript/#modals">JS Metods</a><br><br>
Template:<xmp><div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-close" aria-hidden="true"></i>
                </button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                ...
            </div>
        </div>
    </div>
</div></xmp>
</blockquote>
            </div>
        </div>


</div>
