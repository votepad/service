/*
* imgPreview jQuery plugin
* Copyright (c) 2009 James Padolsey
* j@qd9.co.uk | http://james.padolsey.com
* Dual licensed under MIT and GPL.
* Updated: 09/02/09
* @author James Padolsey
* @version 0.22
*/
(function($) {

    $.fn.imgPreview = function(options) {

        var settings = $.extend({
            thumbnail_size:140,
            thumbnail_border:"5px solid #fff",
            thumbnail_shadow:"0 0 4px rgba(0, 0, 0, 0.5)",
        },options);

        $(this).each(function() {
            if(typeof FileReader == "undefined") return true;

            var elem = $(this);
            var scaleWidth = settings.thumbnail_size * 1.5;
            var fileInput = $('<input>').attr({
                type:"file",
                name:elem.attr("name")
            }).bind('change', function(e) {
                doImgPreview(e);
            });

            var form = elem.parent();

            while(!form.is("form")) {
                form = form.parent();
            }

            var doImgPreview = function(e) {
                var files = e.target.files;    
                for (var i=0, file; file=files[i]; i++) {
                    var number = $('.file-upload').attr('id');
                    number = number.substr(number.lastIndexOf('_')+1,number.length);
                    var labelnumber = ".label-for-photo-error-format_" + number;
                    alter(labelnumber);
                    if (file.type.match('image.*')) {
                        $('.image-preview').css({
                            "background-image":"url(img/no-photo.png)",
                            "border":"5px solid #fff"
                        });
                        $('labelnumber').css({
                            "color":"#757575"
                        });
                        var reader = new FileReader();
                        reader.onload = (function(theFile) {
                            return function(e) {
                                var image = e.target.result;
                                previewDiv = $('.image-preview', newFileInput);
                                previewDiv.css({
                                    "background-image":"url("+image+")",
                                });
                            };
                        })(file);
                        reader.readAsDataURL(file);
                    } else {
                        $('.image-preview').css({
                            "background-image":"url(img/no-photo.png)",
                            "border":"5px solid #ff3111"
                        });
                        $(labelnumber).css({
                            "color":"#ff3111"
                        });
                    }
                }
            }

        });
    }
})(jQuery);