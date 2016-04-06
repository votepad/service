$(document).ready (function() {  
   $.validate();   
   $("#input-event-description").restrictLength( $("#pres-max-length") );
   
   $('input[type=submit]').on('click', function(){
   	var file = $('input[type=file]').val();
   	if(file == ''){
   		$("#update-photo").parent().removeClass("btn-primary").addClass("btn-danger");
         var x = $('.form-control').length - 3;
         for (var i = 1; i <= x; i++) {
            if($('#'+i).val() == '') {$('#'+i).css('border-color','rgb(185, 74, 72)');}
            else{$('#'+i).css('border-color','#27c24c')}
         }
         if($('#input-event-description').val() == '') {$('#input-event-description').css('border-color','rgb(185, 74, 72)');}
         else{$('#input-event-description').css('border-color','#27c24c')}
   	}
   	else{
   		$("#update-photo").parent().removeClass("btn-danger").addClass("btn-primary");
   	}
      var orglen = $('ul.chosen-choices li.search-choice').length;
      if (parseInt(orglen) > 0){
         $('.chosen-choices').css('border-color','#27c24c');
      }else{
         $('.chosen-choices').css('border-color','rgb(185, 74, 72)');
         var x = $('.form-control').length - 3;
         for (var i = 1; i <= x; i++) {
            if($('#'+i).val() == '') {$('#'+i).css('border-color','rgb(185, 74, 72)');}
            else{$('#'+i).css('border-color','#27c24c')}
         }
         if($('#input-event-description').val() == '') {$('#input-event-description').css('border-color','rgb(185, 74, 72)');}
         else{$('#input-event-description').css('border-color','#27c24c')}
      }
   });
   var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-width'     : {width:"95%"}
   }
   for (var selector in config) {
      $(selector).chosen(config[selector]);
   }

   $(".chosen-container-multi").on("click", function() {
      var orglen = $('ul.chosen-choices li.search-choice').length;
      if (parseInt(orglen) > 0){
         $('.chosen-choices').css('border-color','#27c24c');
      }else{
         $('.chosen-choices').css('border-color','rgb(185, 74, 72)');
      }
   });
   $(".chosen-container-multi").focusout(function() {
      var orglen = $('ul.chosen-choices li.search-choice').length;
      if (parseInt(orglen) > 0){
         $('.chosen-choices').css('border-color','#27c24c');
      }else{
         $('.chosen-choices').css('border-color','rgb(185, 74, 72)');
      }
   });

   $.fn.datetimepicker.dates['ru'] = {
      days: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота", "Воскресенье"],
      daysShort: ["Вск", "Пнд", "Втр", "Срд", "Чтв", "Птн", "Суб", "Вск"],
      daysMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вс"],
      months: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
      monthsShort: ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"],
      today: "Сегодня",
      suffix: [],
      meridiem: []
   };
   
   $('.form_datetime').datetimepicker({
      format: 'dd MM yyyy - hh:ii',
      language: 'ru'
   });

   $('.form_datetime').on('change',function(){
      if (($('#input-event-start').val()) == '') {
         $('#input-event-start').css('border-color','rgb(185, 74, 72)');
      }else{
         $('#input-event-start').css('border-color','#27c24c');
      }
      if (($('#input-event-end').val()) == '') {
         $('#input-event-end').css('border-color','rgb(185, 74, 72)');
      }else{
         $('#input-event-end').css('border-color','#27c24c');
      }
   })

});

/*location*/
!function(a,b){"function"==typeof define&&define.amd?define(["jquery"],function(a){return b(a)}):"object"==typeof exports?module.exports=b(require("jquery")):b(jQuery)}(this,function(a){!function(a){a.formUtils.addValidator({name:"country",validatorFunction:function(b){return a.inArray(b.toLowerCase(),this.countries)>-1},countries:["afghanistan","albania","algeria","american samoa","andorra","angola","anguilla","antarctica","antigua and barbuda","arctic ocean","argentina","armenia","aruba","ashmore and cartier islands","atlantic ocean","australia","austria","azerbaijan","bahamas","bahrain","baltic sea","baker island","bangladesh","barbados","bassas da india","belarus","belgium","belize","benin","bermuda","bhutan","bolivia","borneo","bosnia and herzegovina","botswana","bouvet island","brazil","british virgin islands","brunei","bulgaria","burkina faso","burundi","cambodia","cameroon","canada","cape verde","cayman islands","central african republic","chad","chile","china","christmas island","clipperton island","cocos islands","colombia","comoros","cook islands","coral sea islands","costa rica","croatia","cuba","cyprus","czech republic","democratic republic of the congo","denmark","djibouti","dominica","dominican republic","east timor","ecuador","egypt","el salvador","equatorial guinea","eritrea","estonia","ethiopia","europa island","falkland islands","faroe islands","fiji","finland","france","french guiana","french polynesia","french southern and antarctic lands","gabon","gambia","gaza strip","georgia","germany","ghana","gibraltar","glorioso islands","greece","greenland","grenada","guadeloupe","guam","guatemala","guernsey","guinea","guinea-bissau","guyana","haiti","heard island and mcdonald islands","honduras","hong kong","howland island","hungary","iceland","india","indian ocean","indonesia","iran","iraq","ireland","isle of man","israel","italy","jamaica","jan mayen","japan","jarvis island","jersey","johnston atoll","jordan","juan de nova island","kazakhstan","kenya","kerguelen archipelago","kingman reef","kiribati","kosovo","kuwait","kyrgyzstan","laos","latvia","lebanon","lesotho","liberia","libya","liechtenstein","lithuania","luxembourg","macau","macedonia","madagascar","malawi","malaysia","maldives","mali","malta","marshall islands","martinique","mauritania","mauritius","mayotte","mediterranean sea","mexico","micronesia","midway islands","moldova","monaco","mongolia","montenegro","montserrat","morocco","mozambique","myanmar","namibia","nauru","navassa island","nepal","netherlands","netherlands antilles","new caledonia","new zealand","nicaragua","niger","nigeria","niue","norfolk island","north korea","north sea","northern mariana islands","norway","oman","pacific ocean","pakistan","palau","palmyra atoll","panama","papua new guinea","paracel islands","paraguay","peru","philippines","pitcairn islands","poland","portugal","puerto rico","qatar","republic of the congo","reunion","romania","ross sea","russia","rwanda","saint helena","saint kitts and nevis","saint lucia","saint pierre and miquelon","saint vincent and the grenadines","samoa","san marino","sao tome and principe","saudi arabia","senegal","serbia","seychelles","sierra leone","singapore","slovakia","slovenia","solomon islands","somalia","south africa","south georgia and the south sandwich islands","south korea","southern ocean","spain","spratly islands","sri lanka","sudan","suriname","svalbard","swaziland","sweden","switzerland","syria","taiwan","tajikistan","tanzania","tasman sea","thailand","togo","tokelau","tonga","trinidad and tobago","tromelin island","tunisia","turkey","turkmenistan","turks and caicos islands","tuvalu","uganda","ukraine","united arab emirates","united kingdom","uruguay","usa","uzbekistan","vanuatu","venezuela","viet nam","virgin islands","wake island","wallis and futuna","west bank","western sahara","yemen","zambia","zimbabwe"],errorMessage:"",errorMessageKey:"badCustomVal"}),a.formUtils.addValidator({name:"federatestate",validatorFunction:function(b){return a.inArray(b.toLowerCase(),this.states)>-1},states:["alabama","alaska","arizona","arkansas","california","colorado","connecticut","delaware","florida","georgia","hawaii","idaho","illinois","indiana","iowa","kansas","kentucky","louisiana","maine","maryland","district of columbia","massachusetts","michigan","minnesota","mississippi","missouri","montana","nebraska","nevada","new hampshire","new jersey","new mexico","new york","north carolina","north dakota","ohio","oklahoma","oregon","pennsylvania","rhode island","south carolina","south dakota","tennessee","texas","utah","vermont","virginia","washington","west virginia","wisconsin","wyoming"],errorMessage:"",errorMessageKey:"badCustomVal"}),a.formUtils.addValidator({name:"longlat",validatorFunction:function(a){var b=/^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?),\s*[-+]?(180(\.0+)?|((1[0-7]\d)|([1-9]?\d))(\.\d+)?)$/;return b.test(a)},errorMessage:"",errorMessageKey:"badCustomVal"});var b=function(b){var c=[];return a.each(b,function(a,b){c.push(b.substr(0,1).toUpperCase()+b.substr(1,b.length))}),c.sort(),c};a.fn.suggestCountry=function(c){var d=b(a.formUtils.validators.validate_country.countries),e=a.inArray(d,"Usa");return d[e]="USA",a.formUtils.suggest(this,d,c)},a.fn.suggestState=function(c){var d=b(a.formUtils.validators.validate_federatestate.states);return a.formUtils.suggest(this,d,c)}}(a)});
/*file*/
!function(a,b){"function"==typeof define&&define.amd?define(["jquery"],function(a){return b(a)}):"object"==typeof exports?module.exports=b(require("jquery")):b(jQuery)}(this,function(a){!function(a,b){"use strict";var c="undefined"!=typeof b.FileReader,d=function(b){var c=a.split((b.valAttr("allowing")||"").toLowerCase());return a.inArray("jpg",c)>-1&&-1===a.inArray("jpeg",c)?c.push("jpeg"):a.inArray("jpeg",c)>-1&&-1===a.inArray("jpg",c)&&c.push("jpg"),c},e=function(a,b,c,d){var e=d[b]||"";a.errorMessageKey="",a.errorMessage=e.replace("%s",c)},f=function(a){b.console&&b.console.log&&b.console.log(a)},g=function(c,d,e){var f=new FileReader,g=new Image;f.readAsDataURL(c),f.onload=function(c){g.onload=function(){a(b).trigger("imageValidation",[this]),d(this)},g.onerror=function(){e()},g.src=c.target.result}};a.formUtils.addValidator({name:"mime",validatorFunction:function(b,g,h,i){if(c){var j=!0,k=g.get(0).files||[],l="",m=d(g);return k.length&&(a.each(k,function(b,c){return j=!1,l=c.type||"",a.each(m,function(a,b){return j=l.indexOf(b)>-1,j?!1:void 0}),j}),j||(f("Trying to upload a file with mime type "+l+" which is not allowed"),e(this,"wrongFileType",m.join(", "),i))),j}return f("FileReader not supported by browser, will check file extension"),a.formUtils.validators.validate_extension.validatorFunction(b,g,h,i)},errorMessage:"",errorMessageKey:"wrongFileType"}),a.formUtils.addValidator({name:"extension",validatorFunction:function(b,c,f,g){var h=!0,i=this,j=d(c);return a.each(c.get(0).files||[b],function(b,c){var d="string"==typeof c?c:c.value||c.fileName||c.name,f=d.substr(d.lastIndexOf(".")+1);return-1===a.inArray(f.toLowerCase(),j)?(h=!1,e(i,"wrongFileType",j.join(", "),g),!1):void 0}),h},errorMessage:"",errorMessageKey:"wrongFileType"}),a.formUtils.addValidator({name:"size",validatorFunction:function(b,d,g,h){var i=d.valAttr("max-size");if(!i)return f('Input "'+d.attr("name")+'" is missing data-validation-max-size attribute'),!0;if(!c)return!0;var j=a.formUtils.convertSizeNameToBytes(i),k=!0;return a.each(d.get(0).files||[],function(a,b){return k=b.size<=j}),k||e(this,"wrongFileSize",i,h),k},errorMessage:"",errorMessageKey:"wrongFileSize"}),a.formUtils.convertSizeNameToBytes=function(a){return a=a.toUpperCase(),"M"===a.substr(a.length-1,1)?1024*parseInt(a.substr(0,a.length-1),10)*1024:"MB"===a.substr(a.length-2,2)?1024*parseInt(a.substr(0,a.length-2),10)*1024:"KB"===a.substr(a.length-2,2)?1024*parseInt(a.substr(0,a.length-2),10):"B"===a.substr(a.length-1,1)?parseInt(a.substr(0,a.length-1),10):parseInt(a,10)};var h=function(){return!1};a.formUtils.checkImageDimension=function(a,b,c){var d=!1,e={width:0,height:0},f=function(a){a=a.replace("min","").replace("max","");var b=a.split("x");e.width=b[0],e.height=b[1]?b[1]:b[0]},g=!1,h=!1,i=b.split("-");return 1===i.length?0===i[0].indexOf("min")?g=i[0]:h=i[0]:(g=i[0],h=i[1]),g&&(f(g),(a.width<e.width||a.height<e.height)&&(d=c.imageTooSmall+" ("+c.min+" "+e.width+"x"+e.height+"px)")),!d&&h&&(f(h),(a.width>e.width||a.height>e.height)&&(d=a.width>e.width?c.imageTooWide+" "+e.width+"px":c.imageTooTall+" "+e.height+"px",d+=" ("+c.max+" "+e.width+"x"+e.height+"px)")),d},a.formUtils.checkImageRatio=function(a,b,c){var d=a.width/a.height,e=function(a){var b=a.replace("max","").replace("min","").split(":");return b[0]/b[1]},f=b.split("-"),g=function(a,b,c){return a>=b&&c>=a};if(1===f.length){if(d!==e(f[0]))return c.imageRatioNotAccepted}else if(2===f.length&&!g(d,e(f[0]),e(f[1])))return c.imageRatioNotAccepted;return!1},a.formUtils.addValidator({name:"dimension",validatorFunction:function(b,d,e,f,i){var j=!1;if(c){var k=d.get(0).files||[];if(j=!0,-1===d.attr("data-validation").indexOf("mime"))return alert("You should validate file type being jpg, gif or png on input "+d[0].name),!1;if(k.length>1)return alert("Validating image dimensions does not support inputs allowing multiple files"),!1;if(0===k.length)return!0;if(d.valAttr("has-valid-dim"))return!0;if(d.valAttr("has-not-valid-dim"))return this.errorMessage=f.wrongFileDim+" "+d.valAttr("has-not-valid-dim"),!1;if("keyup"===a.formUtils.eventType)return null;var l=!1;return a.formUtils.isValidatingEntireForm&&(l=!0,a.formUtils.haltValidation=!0,i.bind("submit",h).addClass("on-blur")),g(k[0],function(b){var c=!1;d.valAttr("dimension")&&(c=a.formUtils.checkImageDimension(b,d.valAttr("dimension"),f)),!c&&d.valAttr("ratio")&&(c=a.formUtils.checkImageRatio(b,d.valAttr("ratio"),f)),c?d.valAttr("has-not-valid-dim",c):d.valAttr("has-valid-dim","true"),d.valAttr("has-keyup-event")||d.valAttr("has-keyup-event","1").bind("keyup change",function(b){9!==b.keyCode&&16!==b.keyCode&&a(this).valAttr("has-not-valid-dim",!1).valAttr("has-valid-dim",!1)}),l?(a.formUtils.haltValidation=!1,i.removeClass("on-blur").get(0).onsubmit=function(){},i.unbind("submit",h),i.trigger("submit")):d.trigger("blur")},function(a){throw a}),!0}return j},errorMessage:"",errorMessageKey:""}),a(b).one("validatorsLoaded formValidationSetup",function(b,c){var d;d=c?c.find('input[type="file"]'):a('input[type="file"]'),d.filter("*[data-validation]").bind("change",function(){a(this).removeClass("error").parent().find(".form-error").remove()})})}(a,window)});
