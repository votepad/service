$(document).ready(function() {

  var cropImgData; // data about croppinf img

  // checking btns and adding areas for upload
  if ($('.upload').is('#orglogo_upload') == true) {
    var atr = 'orglogo';
    var temp = "<div id='upload_" + atr + "_block' class='displaynone'><div class='upload-fone displaynone'></div><div class='upload-layer'><form name='" + atr + "'><div class='upload-box'><a class='photo_close'>Закрыть</a><div id='" + atr + "_photo_upload' class='upload_input displayblock'><div class='photo_title'>" + getPhotoTitle(atr) + "</div><div class='photo_desc'>" + getPhotoDesc(atr)  + "<br>Вы можете загрузить изображение в формате JPG, JPEG или PNG.</div><div class='msg displaynone' id='" + atr + "_photo_error'></div><div id='" + atr + "_photo_input' class='photo_input-btn'><label for='" + atr + "photo_input' class='md-btn md-btn-md md-btn-success'>Выбрать файл</label><input type='file' id='" + atr + "photo_input' class='photo_input' name='photo" + atr + "'></div></div><div id='" + atr + "_photo_edit' class='photo_edit displaynone'><div class='photo_title'>Редактирование изображения</div><div class='photo_desc'>Выберите область, которая будет показываться.<br>Если изображение ориентировано неправильно, фотографию можно повернуть.</div><img id='" + atr + "_edited' class='edited_photo' src=''><button type='button' aria-label='submit_photo' class='md-btn md-btn-md md-btn-success update-photo-btn'>Обновить</button><div class='edit-btns'><button aria-label='rotateLeft' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-rotate-left'></em></button><button aria-label='rotateRight' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-rotate-right'></em></button></div><div class='edit-btns'><button aria-label='zoomin' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-search-plus'></em></button><button aria-label='zoomout' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-search-minus'></em></button></div><div class='edit-btns'><button aria-label='move' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-arrows'></em></button><button aria-label='crop' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-crop'></em></button></div></div></div></form></div></div>";
    $(".content-wrapper").after(temp);
  }
  if ($('.upload').is('#orgback_upload') == true) {
    var atr = 'orgback';
    var temp = "<div id='upload_" + atr + "_block' class='displaynone'><div class='upload-fone displaynone'></div><div class='upload-layer'><form name='" + atr + "'><div class='upload-box'><a class='photo_close'>Закрыть</a><div id='" + atr + "_photo_upload' class='upload_input displayblock'><div class='photo_title'>" + getPhotoTitle(atr) + "</div><div class='photo_desc'>" + getPhotoDesc(atr)  + "<br>Вы можете загрузить изображение в формате JPG, JPEG или PNG.</div><div class='msg displaynone' id='" + atr + "_photo_error'></div><div id='" + atr + "_photo_input' class='photo_input-btn'><label for='" + atr + "photo_input' class='md-btn md-btn-md md-btn-success'>Выбрать файл</label><input type='file' id='" + atr + "photo_input' class='photo_input' name='photo" + atr + "'></div></div><div id='" + atr + "_photo_edit' class='photo_edit displaynone'><div class='photo_title'>Редактирование изображения</div><div class='photo_desc'>Выберите область, которая будет показываться.<br>Если изображение ориентировано неправильно, фотографию можно повернуть.</div><img id='" + atr + "_edited' class='edited_photo' src=''><button type='button' aria-label='submit_photo' class='md-btn md-btn-md md-btn-success update-photo-btn'>Обновить</button><div class='edit-btns'><button aria-label='rotateLeft' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-rotate-left'></em></button><button aria-label='rotateRight' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-rotate-right'></em></button></div><div class='edit-btns'><button aria-label='zoomin' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-search-plus'></em></button><button aria-label='zoomout' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-search-minus'></em></button></div><div class='edit-btns'><button aria-label='move' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-arrows'></em></button><button aria-label='crop' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-crop'></em></button></div></div></div></form></div></div>";
    $(".content-wrapper").after(temp);
  }
  if ($('.upload').is('#eventlogo_upload') == true) {
    var atr = 'eventlogo';
    var temp = "<div id='upload_" + atr + "_block' class='displaynone'><div class='upload-fone displaynone'></div><div class='upload-layer'><form name='" + atr + "'><div class='upload-box'><a class='photo_close'>Закрыть</a><div id='" + atr + "_photo_upload' class='upload_input displayblock'><div class='photo_title'>" + getPhotoTitle(atr) + "</div><div class='photo_desc'>" + getPhotoDesc(atr)  + "<br>Вы можете загрузить изображение в формате JPG, JPEG или PNG.</div><div class='msg displaynone' id='" + atr + "_photo_error'></div><div id='" + atr + "_photo_input' class='photo_input-btn'><label for='" + atr + "photo_input' class='md-btn md-btn-md md-btn-success'>Выбрать файл</label><input type='file' id='" + atr + "photo_input' class='photo_input' name='photo" + atr + "'></div></div><div id='" + atr + "_photo_edit' class='photo_edit displaynone'><div class='photo_title'>Редактирование изображения</div><div class='photo_desc'>Выберите область, которая будет показываться.<br>Если изображение ориентировано неправильно, фотографию можно повернуть.</div><img id='" + atr + "_edited' class='edited_photo' src=''><button type='button' aria-label='submit_photo' class='md-btn md-btn-md md-btn-success update-photo-btn'>Обновить</button><div class='edit-btns'><button aria-label='rotateLeft' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-rotate-left'></em></button><button aria-label='rotateRight' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-rotate-right'></em></button></div><div class='edit-btns'><button aria-label='zoomin' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-search-plus'></em></button><button aria-label='zoomout' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-search-minus'></em></button></div><div class='edit-btns'><button aria-label='move' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-arrows'></em></button><button aria-label='crop' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-crop'></em></button></div></div></div></form></div></div>";
    $(".content-wrapper").after(temp);
  }
  
  function getPhotoTitle(id){
    if (id == 'orglogo') {return("Загрузка логотипа организации")};
    if (id == 'orgback') {return("Загрузка фона обложки организации")};
    if (id == 'eventlogo') {return("Загрузка логотипа мероприятия")};
  };
  function getPhotoDesc(id){
    if (id == 'orglogo') {return("Вашу организацию будет проще узнать, если загрузите настоящий логотип.")};
    if (id == 'orgback') {return("Ваша страница станет ярче, если обновите фон обложки.")};
    if (id == 'eventlogo') {return("Ваше мероприятие будет проще узнать, если загрузите настоящий логотип.")};
  };
  function getInputID(str) {
    var temp = "";
    for (var i = 0; i < str.length; i++) {
      if (str[i] != '_'){ temp = temp+str[i]; } 
      else{ break; }
    }
    return temp;
  }

  // open uploading form
  $('.upload').click(function(){
    var photoID = getInputID($(this).attr('id'));
    $('#upload_' + photoID + '_block').removeClass('displaynone').addClass('displayblock');
    $('.upload-fone').removeClass('displaynone').addClass('displayblock');
    $('body').addClass('blocked');
  });
  // close uploading form
  function close(photoID){
    $('#upload_' + photoID + '_block').removeClass('displayblock').addClass('displaynone');
    $('.upload-fone').removeClass('displayblock').addClass('displaynone');
    $('body').removeClass('blocked');
    $('.upload_input').removeClass('displaynone').addClass('displayblock');
    $('.photo_edit').removeClass('displayblock').addClass('displaynone');
    $('.msg').removeClass('displayblock').addClass('displaynone').empty();
  };
  $('.photo_close').click(function(){
    close($(this).parent().parent().attr('name'));
  });

  var param = [
    {id:"orglogo", minImgWidth: "170", minImgHeigth: "170", maxImgSize: "1000000", ImgFormat: '["image/jpg", "image/jpeg", "image/png"]'},
    {id:"orgback", minImgWidth: "768", minImgHeigth: "300", maxImgSize: "2000000", ImgFormat: '["image/jpg", "image/jpeg", "image/png"]'},
    {id:"eventlogo", minImgWidth: "200", minImgHeigth: "200", maxImgSize: "1000000", ImgFormat: '["image/jpg", "image/jpeg", "image/png"]'},
  ];

  function getParamNum(id) {
    for (var i = 0; i < param.length; i++) {
      if (param[i].id == id) {return i}
    }
  }
  function getFormat(str) {
    console.log(str);
    return str.replace(/[^a-z^,]/gim,'').toUpperCase().replace(/IMAGE/g, ' ');
  }

  $('.photo_input').change( function(){    
    $('.msg').removeClass('displayblock').addClass('displaynone').empty();
    var photoID = getInputID($(this).parent().attr('id'));
    var file;
    var maxImgSize = parseInt(param[getParamNum(photoID)].maxImgSize);
    var ImgFormat = param[getParamNum(photoID)].ImgFormat;
    var minImgWidth = parseInt(param[getParamNum(photoID)].minImgWidth);
    var minImgHeigth = parseInt(param[getParamNum(photoID)].minImgHeigth);
    
    if ( ( file = this.files[0] ) ) {
      var reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = function (e) {
        if (file.size > maxImgSize) { msg_error(photoID, 1); return false; }
        else if (ImgFormat.indexOf(file.type) == -1) { msg_error(photoID, 2); return false; }

        var img = new Image();
        img.src = e.target.result;
        if (img.width < minImgWidth || img.width > 7000) { msg_error(photoID, 3); return false; }
        else if (img.height < minImgHeigth || img.width > 7000) { msg_error(photoID, 4); return false; }

        $('#'+photoID+'_photo_input').after("<div class='uploadtext'>Загрузка ...</div>");
        $('#'+photoID+'_edited').attr('src', e.target.result);
        $('#'+photoID+'_edited').cropper("replace", e.target.result);
        $('.upload_input').removeClass('displayblock').addClass('displaynone');
        $('.photo_edit').removeClass('displaynone').addClass('displayblock');
        $('.uploadtext').remove();
      }
    }
  });

        
  // ERROR MSG
  function msg_error(photoID, id){
    $('#'+photoID+'_photo_error').removeClass('displaynone').addClass('displayblock');
    if (id == 1) { $('#'+photoID+'_photo_error').append('<p style="font-weight: bold; margin:0;color:black">К сожалению, произошла ошибка.</p><p>Фотография должна иметь размер не более ' + parseInt(param[getParamNum(photoID)].maxImgSize)/1000000 + ' Мб</p>') }
    if (id == 2) { $('#'+photoID+'_photo_error').append('<p style="font-weight: bold; margin:0;color:black">К сожалению, произошла ошибка.</p><p>Фотография должна иметь формат: ' + getFormat(param[getParamNum(photoID)].ImgFormat) + '</p>') }
    if (id == 3) { $('#'+photoID+'_photo_error').append('<p style="font-weight: bold; margin:0;color:black">К сожалению, произошла ошибка.</p><p>Фотография должна иметь ширину не меньше ' + param[getParamNum(photoID)].minImgWidth + ' точек и не больше 7 000 точек.</p>') }
    if (id == 4) { $('#'+photoID+'_photo_error').append('<p style="font-weight: bold; margin:0;color:black">К сожалению, произошла ошибка.</p><p>Фотография должна иметь высоту не меньше ' + param[getParamNum(photoID)].minImgHeigth + ' точек и не больше 7 000 точек.</p>') }
  };


  //  CROPPER BTNS
  $('button[aria-label="rotateLeft"]').click(function(){
    var photoID = getInputID($(this).parent().parent().attr('id'));
    $('#'+photoID+'_edited').cropper('rotate', -90);
  });
  $('button[aria-label="rotateRight"]').click(function(){
    var photoID = getInputID($(this).parent().parent().attr('id'));
    $('#'+photoID+'_edited').cropper('rotate', 90);
  });
  $('button[aria-label="zoomin"]').click(function(){
    var photoID = getInputID($(this).parent().parent().attr('id'));
    $('#'+photoID+'_edited').cropper('zoom', 0.1);
  });
  $('button[aria-label="zoomout"]').click(function(){
    var photoID = getInputID($(this).parent().parent().attr('id'));
    $('#'+photoID+'_edited').cropper('zoom', -0.1);
  });
  $('button[aria-label="move"]').click(function(){
    var photoID = getInputID($(this).parent().parent().attr('id'));
    $('#'+photoID+'_edited').cropper("setDragMode", "move");
  });
  $('button[aria-label="crop"]').click(function(){
    var photoID = getInputID($(this).parent().parent().attr('id'));
    $('#'+photoID+'_edited').cropper("setDragMode", "crop");
  });

  // SUBMIT uploading img using cropper and ajax
  
  $('button[aria-label="submit_photo"]').click(function(){
    var photoID = getInputID($(this).parent().attr('id'));
    $('#'+photoID+'_edited').cropper('getCroppedCanvas').toBlob(function (blob) {
      var formData = new FormData();
      formData.append("id", photoID);
      formData.append("file", blob);
      formData.append("crop", cropImgData);

      console.log(formData);

      $.ajax('/path/to/upload', {
        method: "POST",
        data: formData,
        processData: false, 
        contentType: false,
        success: function () {
          console.log('Upload success');
        },
        error: function () {
          console.log('Upload error');
        }
      });
    });
    close(photoID);
  });

  //  CROPPER SETTINGS
  $('#orglogo_edited').cropper({
    aspectRatio: 1 / 1,
    minCropBoxWidth: 100,
    minCropBoxHeight: 100,
    crop: function (data) {
      cropImgData = data; // save returned data to cropImgData.
      //console.log(cropImgData);   //cropImgData is the returned data from cropper
    },
  });
  $('#orgback_edited').cropper({
    aspectRatio: 3 / 1,
    minCropBoxWidth: 300,
    minCropBoxHeight: 100,
    crop: function (data) {
      cropImgData = data; // save returned data to cropImgData.
      //console.log(cropImgData);   //cropImgData is the returned data from cropper
    },
  });
  $('#eventlogo_edited').cropper({
    aspectRatio: 1 / 1,
    minCropBoxWidth: 100,
    minCropBoxHeight: 100,
    crop: function (data) {
      cropImgData = data; // save returned data to cropImgData.
      //console.log(cropImgData);   //cropImgData is the returned data from cropper
    },
  });

});