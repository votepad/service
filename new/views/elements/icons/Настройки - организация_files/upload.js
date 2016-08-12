$(document).ready(function() {
    
  var photoID;
  var cropImgData;

  if ($('.upload').is('#logo_upload') == true) {
    var atr = 'logo';    
    var temp = "<div id='upload_" + atr + "_block' class='displaynone'><div class='upload-fone displaynone'></div><div class='upload-layer'><form action='"+ getAction(atr) +"' method='post' role='form'><div class='upload-box'><a class='photo_close'>Закрыть</a><div id='" + atr + "_photo_upload' class='upload_input displayblock'><div class='photo_title'>" + getPhotoTitle(atr) + "</div><div class='photo_desc'>" + getPhotoDesc(atr)  + "<br>Вы можете загрузить изображение в формате JPG, JPEG или PNG.</div><div class='msg' id='" + atr + "_photo_error'></div><div id='" + atr + "_photo_input'><label for='photo_input' class='md-btn md-btn-md md-btn-success'>Выбрать файл</label><input type='file' id='photo_input' class='photo_input' name='photo'></div><div id='" + atr + "_progress_bar' class='progress-bar-box displaynone'><div class='bar'></div></div></div><div id='" + atr + "_photo_edit' class='photo_edit displaynone'><div class='photo_title'>Редактирование изображения</div><div class='photo_desc'>Выберите область, которая будет показываться.<br>Если изображение ориентировано неправильно, фотографию можно повернуть.</div><img id='" + atr + "_edited' class='edited_photo' src=''><md-button aria-label='submit_photo' class='md-btn md-btn-md md-btn-success update-photo-btn'>Обновить</md-button><div class='edit-btns'><md-button aria-label='rotateLeft' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><md-icon md-svg-icon='../../assets/img/icons/rotateLeft.svg'></md-icon></md-button><md-button aria-label='rotateRight' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><md-icon md-svg-icon='../../assets/img/icons/rotateRight.svg'></md-icon></md-button></div><div class='edit-btns'><md-button aria-label='zoomin' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><md-icon md-svg-icon='../../assets/img/icons/zoom-in.svg'></md-icon></md-button><md-button aria-label='zoomout' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><md-icon md-svg-icon='../../assets/img/icons/zoom-out.svg'></md-icon></md-button></div><div class='edit-btns'><md-button aria-label='move' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><md-icon md-svg-icon='../../assets/img/icons/move.svg'></md-icon></md-button><md-button aria-label='crop' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><md-icon md-svg-icon='../../assets/img/icons/crop.svg'></md-icon></md-button></div></div></div></form></div></div>";
    $(".content-wrapper").after(temp);
  }
  
  $('.upload').click(function(){
  //  photoID = getInputID($(this).attr('aria-label'));
//    var temp = "<div id='upload_" + photoID + "_block' class='displaynone'><div class='upload-fone displaynone'></div><div class='upload-layer'><form action='"+ getAction(photoID) +"' method='post' role='form'><div class='upload-box'><a class='photo_close'>Закрыть</a><div id=" + photoID + "_photo_upload' class='upload_input displayblock'><div class='photo_title'>" + getPhotoTitle(photoID) + "</div><div class='photo_desc'>" + getPhotoDesc(photoID)  + "<br>Вы можете загрузить изображение в формате JPG, JPEG или PNG.</div><div class='msg' id='" + photoID + "_photo_error'></div><div id='" + photoID + "_photo_input'><label for='photo_input' class='md-btn md-btn-md md-btn-success'>Выбрать файл</label><input type='file' id='photo_input' class='photo_input' name='photo'></div><div id='" + photoID + "_progress_bar' class='progress-bar-box displaynone'><div class='bar'></div></div></div><div id='" + photoID + "_photo_edit' class='photo_edit displaynone'><div class='photo_title'>Редактирование изображения</div><div class='photo_desc'>Выберите область, которая будет показываться.<br>Если изображение ориентировано неправильно, фотографию можно повернуть.</div><img id='" + photoID + "_edited' class='edited_photo' src=''><md-button aria-label='submit_photo' class='md-btn md-btn-md md-btn-success update-photo-btn'>Обновить</md-button><div class='edit-btns'><md-button aria-label='rotateLeft' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><md-icon md-svg-icon='../../assets/img/icons/rotateLeft.svg'></md-icon></md-button><md-button aria-label='rotateRight' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><md-icon md-svg-icon='../../assets/img/icons/rotateRight.svg'></md-icon></md-button></div><div class='edit-btns'><md-button aria-label='zoomin' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><md-icon md-svg-icon='../../assets/img/icons/zoom-in.svg'></md-icon></md-button><md-button aria-label='zoomout' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><md-icon md-svg-icon='../../assets/img/icons/zoom-out.svg'></md-icon></md-button></div><div class='edit-btns'><md-button aria-label='move' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><md-icon md-svg-icon='../../assets/img/icons/move.svg'></md-icon></md-button><md-button aria-label='crop' class='md-btn md-btn-md md-btn-default md-btn-icon-sq'><md-icon md-svg-icon='../../assets/img/icons/crop.svg'></md-icon></md-button></div></div></div></form></div></div>";

    //$(".content-wrapper").after(temp);
    $('#upload_logo_block').removeClass('displaynone').addClass('displayblock');
    $('.upload-fone').removeClass('displaynone').addClass('displayblock');
    $('body').addClass('blocked');
  });

  function getPhotoDesc(id){
    return("Вашу организацию будет проще узнать, если загрузите настоящий логотип.");
  };

  function getPhotoTitle(id){
    return("Загрузка логотипа организации");
  };
  
//width == 0 при change
  function getAction(id){

  };

  var close = function(){
    $('#upload_logo_block').removeClass('displaynblock').addClass('displaynone');
    $('.upload-fone').removeClass('displayblock').addClass('displaynone');
    $('body').removeClass('blocked');
    $('.upload_input').removeClass('displaynone').addClass('displayblock');
    $('.dropbox').removeClass('displayblock').addClass('displaynone');
    $('.photo_edit').removeClass('displayblock').addClass('displaynone');
  };

  $('.photo_close').click(function(){
//    alert(1);
    close();  
  });

  function getInputID(str) {
    var temp = "";
    for (var i = 0; i < str.length; i++) {
      if (str[i] != '_'){ temp = temp+str[i]; } 
      else{ break; }
    }
    return temp;
  }


  $('#photo_input').fileupload({
    imageCrop: true,
    change: function(e, data) {
      photoID = getInputID($(this).parent().attr('id'));
      if (data.files && data.files[0]) {
        var reader = new FileReader();
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
    }
  });

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

  
  $('button[aria-label="submit_photo"]').click(function(){
  /*   $('#'+photoID+'_edited').cropper({
      crop: function (data) {
        cropImgData = data; // save returned data to cropImgData.
        console.log(cropImgData);   //cropImgData is the returned data from cropper
      },
      built: function () {
        $btn.on('click', function () {
          alert(cropImgData);
          $.ajax({
            type: "POST",
            url: 'inc/settings_customers_uploader_tn.php',
            data: cropImgData,
            success: function(res) {
                console.log(res);
            }
          });
        });
      }
    });
*/

    $('#'+photoID+'_edited').cropper('getCroppedCanvas').toBlob(function (blob) {
      var formData = new FormData();
      formData.append(cropImgData, blob);
      console.log(formData);
      //console.log(cropImgData);
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

  $('#logo_edited').cropper({
    aspectRatio: 1 / 1,
    minCropBoxWidth: 170,
    minCropBoxHeight: 170,
  });

  $('.edited_photo').cropper({
    crop: function (data) {
      cropImgData = data; // save returned data to cropImgData.
      //console.log(cropImgData);   //cropImgData is the returned data from cropper
    },
  });

});