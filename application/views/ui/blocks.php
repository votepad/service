<!--  PAGE SCRIPTS  -->
<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-transition.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-collapse.js"></script>


<div class="row">

    <h3 class="page-header">Blocks (collapse and refresh)</h3>

    <div class="row row-col">
        <div class="col-xs-12 col-md-6">
            <div class="block block-default">
                <div class="block-heading">
                    <h4>Collapse Block</h4>
                    <a data-toggle="collapse" href="#collapseExample_1" aria-expanded="true" aria-controls="collapseExample_1">
                        <i class="fa fa-minus" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="collapse in" id="collapseExample_1">
                    <div class="block-body">
                        Panel can be collapsed clicking on the icon on the top right corner
                    </div>
                    <div class="block-footer">
                        Block Footer
                    </div>
                </div>
            </div>
            <div class="block block-default">
                <div class="block-heading">
                    <h4>Collapse Block</h4>
                    <a data-toggle="collapse" href="#collapseExample_2" aria-expanded="false" aria-controls="collapseExample_2">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="collapse" id="collapseExample_2">
                    <div class="block-body">
                        Panel can be collapsed clicking on the icon on the top right corner
                    </div>
                    <div class="block-footer">
                        Block Footer
                    </div>
                </div>
            </div>
            <div class="block block-default">
                <div class="block-heading">
                    <h4>Refresh Block</h4>
                    <a data-toggle="refresh">
                        <i class="fa fa-refresh" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="collapse in" id="collapseExample_3">
                    <div class="block-body">
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

    <div class="row">
        <div class="row row-col">
            <div class="col-xs-12 col-md-6">
                <div class="block block-default">
                    <div class="block-heading">
                        <h4>Default Block</h4>
                    </div>
                    <div class="block-body">
                        <p>
                            NWE - система информационной поддержки мероприятий, разработанная студентами нашего университета. Система предоставляет такие функции как просмотр рейтинга участников в режиме реального времени; автоматический подсчет баллов, выставленных членами жюри.
                        </p>
                    </div>
                    <div class="block-footer">
                        © Noteworthy Event
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
<blockquote><xmp><div class="block block-default">
    <div class="block-heading">
        <h4> ... </h4>
    </div>
    <div class="block-body">
        ...
    </div>
    <div class="block-footer">
        ...
    </div>
</div>
</xmp></blockquote>
            </div>
        </div>


        <div class="row row-col">
            <div class="col-xs-12 col-md-6">
                <div class="block block-_____">
                    <div class="block-heading">
                        <h4>_____ Block</h4>
                    </div>
                    <div class="block-body">
                        <p>
                            content
                        </p>
                    </div>
                    <div class="block-footer">
                        footer
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
<blockquote><xmp><div class="block block-_____">
    <div class="block-heading">
        <h4> ... </h4>
    </div>
    <div class="block-body">
        ...
    </div>
    <div class="block-footer">
        ...
    </div>
</div>
</xmp></blockquote>
            </div>
        </div>
    </div>
</div>
