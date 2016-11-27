<!--<link rel="stylesheet" href="<?=$assets; ?>vendor/handsontable/handsontable.full.min.css">
<link rel="stylesheet" href="<?=$assets; ?>vendor/handsontable/handsontable.removeRow.css">
<script type="text/javascript" src="<?=$assets; ?>vendor/handsontable/handsontable.full.min.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/handsontable/handsontable.removeRow.js"></script>-->
<script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/select2.min.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/i18n/ru.js"></script>

<script type="text/javascript" src="<?=$assets; ?>js/event/teams.js"></script>

<style media="screen">

/*  добавить в класс!  */
.input-field{
    padding: 0 15px;
}
.input-field input + label, .input-field textarea + label{
    top: .5em;
}
.select2-container .select2-selection--multiple .select2-selection__choice__remove{
    vertical-align: middle;
}



    .block{
        position: relative;
        background: #fff;
        border-radius: 3px;
        box-shadow: 0 1px 0 0 #d7d8db, 0 0 0 1px #e3e4e8;
        margin-bottom: 15px;
        border: 0;
    }

    .clear_fix{
        display: block;
    }

    .clear_fix:after, .clear_fix:before{
    	content: " ";
    	display: table;
    	clear: both;
    }

    .block_heading{

    }

    .block_body{
        position: relative;
        border-radius: 3px;
        overflow: hidden;
        height: 44px;
    }

    .block.open .block_body{
        height: auto;
    }

    .block_body .input-field{
        margin-top: .4em;
        margin-bottom: .2em
    }
    .block.open .input-field{
        margin-top: 1em;
    }

    .block_body .input-field > input{
        border-bottom: 0;
    }
    .block.open .input-field > input{
        border-bottom: 1px solid #0097A7;
    }

    .block_body .row{
        margin: 0;
    }
    .block.open .row{
        margin: 20px auto;
    }

    .block .hidden{
        display: none;
    }
    .block.open .hidden{
        display: block;
    }

    .block_submit{
        display: block;
        background: #fafbfc;
        border-top: 1px solid #e7e8ec;
        padding: 15px 30px;
        border-radius: 0 0 2px 2px;
    }

    .input-field textarea{
        min-height: 18px;
    }


    .select2-results__withlogo{
        display: block;
    }
    .select2-results__logo{
        height: 25px;
        width: 25px;
        border-radius: 50%;
        margin-right: 8px;
        vertical-align: middle;
    }
    .select2-results__text{
        vertical-align: middle;
    }

    /*  input[file]  */

    input[type=file] {
        position: absolute;
        width: 0;
        height: 0;
    }



    /* buutons */

    .btn {
        display: inline-block;
        margin-bottom: 0;
        font-weight: 400;
        text-align: center;
        vertical-align: middle;
        touch-action: manipulation;
        cursor: pointer;
        background-image: none;
        border: 1px solid transparent;
        white-space: nowrap;
        padding: 6px 16px;
        font-size: 14px;
        outline: 0;
        border-radius: 3px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -webkit-appearance: none;
        -webkit-transition: all .2s;
        -o-transition: all .2s;
        transition: all .2s;
    }

    .btn-default {
        color: #413a41;
        background-color: #FFF;
        border-color: #E0E0E0;
    }

    .btn-primary{
        color: #FFF;
        background-color: #0097A7;
        border-color: #E0E0E0;
    }

    .btn-default:hover, .btn-default:active{
        background-color: rgba(0,0,0,0.05);
    }
    .btn-primary:hover, .btn-primary:focus{
    	background-color: #1F757D;
    }

    @media (max-width: 481px) {
        .btn.col-xs-12:not(:last-child){
            margin-bottom: 10px;
        }
    }

</style>


<h3 class="page-header">Список команд</h3>


<div class="block" id="new_team">
    <div class="block_body clear_fix">
        <div class="col-xs-12 col-md-6">
            <div class="row row-col">
                <div class="input-field">
                    <input id="team_name-0" type="text" name="" value="">
                    <label for="team_name-0">Введите название команды</label>
                </div>
            </div>
            <div class="row row-col hidden">
                <div class="input-field">
                    <textarea id="team_description-0"></textarea>
                    <label for="team_description-0">Расскажите о команде</label>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="row row-col hidden">
                <div class="input-field">
                    <select name="" id="team_participants-0" multiple="" class="participants_in_team">
                        <option value="01.jpg">участник 1</option>
                        <option value="02.jpg">участник 2</option>
                    </select>
                    <label for="team_participants-0">Состав команды</label>
                </div>
            </div>
        </div>
    </div>
    <div class="block_submit hidden clear_fix">
        <label class="btn btn-default col-xs-12 col-sm-5 col-md-3" for="team_logo">
            <input id="team_logo" type="file" name="" value="">
        	Выбрать логотип
        </label>
        <button type="" class="btn btn-primary col-xs-12 col-sm-5 col-sm-offset-2 col-md-3 col-md-offset-6">
        	Создать команду
        </button>
    </div>
</div>







<div class="row row-col">
    <div class="col-xs-12">
        Список команд в таких же блоках как выше, но немного в другом формате.
        <br>
        пока css менял в этом файле, думаю как доработать UI Bloks
    </div>
</div>

<!--<div class="row" id="teams"></div>-->
