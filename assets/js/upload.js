$(document).ready(function() {
    
  var photoID; // current id of uploading photo
  var cropImgData; // data about croppinf img

  // checking btns and adding areas for upload
  if ($('.upload').is('#logo_upload') == true) {
    var atr = 'logo';
    var temp = "<div id='upload_" + atr + "_block' class='displaynone'><div class='upload-fone displaynone'></div><div class='upload-layer'><form name='" + atr + "'><div class='upload-box'><a class='photo_close'>Закрыть</a><div id='" + atr + "_photo_upload' class='upload_input displayblock'><div class='photo_title'>" + getPhotoTitle(atr) + "</div><div class='photo_desc'>" + getPhotoDesc(atr)  + "<br>Вы можете загрузить изображение в формате JPG, JPEG или PNG.</div><div class='msg displaynone' id='" + atr + "_photo_error'></div><div id='" + atr + "_photo_input' class='photo_input-btn'><label for='" + atr + "photo_input' class='md-btn md-btn-md md-btn-success'>Выбрать файл</label><input type='file' id='" + atr + "photo_input' class='photo_input' name='photo" + atr + "'></div><div id='" + atr + "_progress_bar' class='progress-bar-box displaynone'><div class='bar'></div></div></div><div id='" + atr + "_photo_edit' class='photo_edit displaynone'><div class='photo_title'>Редактирование изображения</div><div class='photo_desc'>Выберите область, которая будет показываться.<br>Если изображение ориентировано неправильно, фотографию можно повернуть.</div><img id='" + atr + "_edited' class='edited_photo' src=''><button type='button' aria-label='submit_photo' class='md-btn md-btn-md md-btn-success update-photo-btn'>Обновить</button><div class='edit-btns'><button aria-label='rotateLeft' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-rotate-left'></em></button><button aria-label='rotateRight' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-rotate-right'></em></button></div><div class='edit-btns'><button aria-label='zoomin' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-search-plus'></em></button><button aria-label='zoomout' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-search-minus'></em></button></div><div class='edit-btns'><button aria-label='move' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-arrows'></em></button><button aria-label='crop' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-crop'></em></button></div></div></div></form></div></div>";
    $(".content-wrapper").after(temp);
  }
  if ($('.upload').is('#back_upload') == true) {
    var atr = 'back';
    var temp = "<div id='upload_" + atr + "_block' class='displaynone'><div class='upload-fone displaynone'></div><div class='upload-layer'><form name='" + atr + "'><div class='upload-box'><a class='photo_close'>Закрыть</a><div id='" + atr + "_photo_upload' class='upload_input displayblock'><div class='photo_title'>" + getPhotoTitle(atr) + "</div><div class='photo_desc'>" + getPhotoDesc(atr)  + "<br>Вы можете загрузить изображение в формате JPG, JPEG или PNG.</div><div class='msg displaynone' id='" + atr + "_photo_error'></div><div id='" + atr + "_photo_input' class='photo_input-btn'><label for='" + atr + "photo_input' class='md-btn md-btn-md md-btn-success'>Выбрать файл</label><input type='file' id='" + atr + "photo_input' class='photo_input' name='photo" + atr + "'></div><div id='" + atr + "_progress_bar' class='progress-bar-box displaynone'><div class='bar'></div></div></div><div id='" + atr + "_photo_edit' class='photo_edit displaynone'><div class='photo_title'>Редактирование изображения</div><div class='photo_desc'>Выберите область, которая будет показываться.<br>Если изображение ориентировано неправильно, фотографию можно повернуть.</div><img id='" + atr + "_edited' class='edited_photo' src=''><button type='button' aria-label='submit_photo' class='md-btn md-btn-md md-btn-success update-photo-btn'>Обновить</button><div class='edit-btns'><button aria-label='rotateLeft' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-rotate-left'></em></button><button aria-label='rotateRight' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-rotate-right'></em></button></div><div class='edit-btns'><button aria-label='zoomin' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-search-plus'></em></button><button aria-label='zoomout' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-search-minus'></em></button></div><div class='edit-btns'><button aria-label='move' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-arrows'></em></button><button aria-label='crop' type='button' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><em class='fa fa-crop'></em></button></div></div></div></form></div></div>";
    $(".content-wrapper").after(temp);
  }
  
  function getPhotoTitle(id){
    if (id == 'logo') {return("Загрузка логотипа организации")};
    if (id == 'back') {return("Загрузка фона обложки организации")};
  };
  function getPhotoDesc(id){
    if (id == 'logo') {return("Вашу организацию будет проще узнать, если загрузите настоящий логотип.")};
    if (id == 'back') {return("Ваша страница станет ярче, если обновите фон обложки.")};
  };
  function getInputID(str) {
    var temp = "";
    for (var i = 0; i < str.length; i++) {
      if (str[i] != '_'){ temp = temp+str[i]; } 
      else{ break; }
    }
    return temp;
  }
  function close(){
    $('#upload_' + photoID + '_block').removeClass('displayblock').addClass('displaynone');
    $('.upload-fone').removeClass('displayblock').addClass('displaynone');
    $('body').removeClass('blocked');
    $('.upload_input').removeClass('displaynone').addClass('displayblock');
    $('.photo_edit').removeClass('displayblock').addClass('displaynone');
  };


  $('.upload').click(function(){
    photoID = getInputID($(this).attr('id'));
    console.log(photoID);
    $('#upload_' + photoID + '_block').removeClass('displaynone').addClass('displayblock');
    $('.upload-fone').removeClass('displaynone').addClass('displayblock');
    $('body').addClass('blocked');
  });

  $('.photo_close').click(function(){
    close();  
  });

  //  working with fileupload - progress bar
  // нужно сделать проверку файла по параметрам

  $('.photo_input').fileupload({
    imageCrop: true,
    imageMaxWidth: 50,
    change: function(e, data) {
      photoID = getInputID($(this).parent().attr('id'));
      if (data.files && data.files[0]) {
        var reader = new FileReader();
        var img = new Image();  
        reader.onload = function (e) {
          $('#'+photoID+'_edited').attr('src', e.target.result);
          $('#'+photoID+'_edited').cropper("replace", e.target.result);
        }
        reader.readAsDataURL(data.files[0]);
      };
      $('#'+photoID+'_progress_bar').removeClass('displaynone').addClass('displayblock');
    },
    progressall: function (e, data) {
      var progress = parseInt(data.loaded / data.total * 100, 10);
      $('#'+photoID+'_progress_bar .bar').css('width', progress + '%');
      $('#'+photoID+'_progress_bar .bar').text('Загрузка: ' + progress + '%');
    },
    done: function (e, data) {
      $('.upload_input').addClass('displaynone');
      $('.photo_edit').removeClass('displaynone').addClass('displayblock');
      $('#'+photoID+'_progress_bar').removeClass('displayblock').addClass('displaynone');
      $('.bar').css('width', '0').text('');
    }
  });


  //  working with cropper

  $('button[aria-label="rotateLeft"]').click(function(){
    $('#'+photoID+'_edited').cropper('rotate', -90);
  });
  $('button[aria-label="rotateRight"]').click(function(){
    $('#'+photoID+'_edited').cropper('rotate', 90);
  });
  $('button[aria-label="zoomin"]').click(function(){
    $('#'+photoID+'_edited').cropper('zoom', 0.1);
  });
  $('button[aria-label="zoomout"]').click(function(){
    $('#'+photoID+'_edited').cropper('zoom', -0.1);
  });
  $('button[aria-label="move"]').click(function(){
    $('#'+photoID+'_edited').cropper("setDragMode", "move");
  });
  $('button[aria-label="crop"]').click(function(){
    $('#'+photoID+'_edited').cropper("setDragMode", "crop");
  });

  // submiting using cropper and ajax
  $('button[aria-label="submit_photo"]').click(function(){
    $('#'+photoID+'_edited').cropper('getCroppedCanvas').toBlob(function (blob) {
      var formData = new FormData();
      formData.append("id", photoID);
      formData.append("file", blob);
      formData.append("crop", cropImgData);
      //console.log(cropImgData);
      //console.log(formData.get("id"));
      //console.log(formData.get("file"));
      //console.log(formData.get("crop"));
      
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
    close();
  });

  // personal settings  

  $('#back_edited').cropper({
    aspectRatio: 3 / 1,
    minCropBoxWidth: 300,
    minCropBoxHeight: 100,
    crop: function (data) {
      cropImgData = data; // save returned data to cropImgData.
      //console.log(cropImgData);   //cropImgData is the returned data from cropper
    },
  });
  $('#logo_edited').cropper({
    aspectRatio: 1 / 1,
    minCropBoxWidth: 100,
    minCropBoxHeight: 100,
    crop: function (data) {
      cropImgData = data; // save returned data to cropImgData.
      //console.log(cropImgData);   //cropImgData is the returned data from cropper
    },
  });

});