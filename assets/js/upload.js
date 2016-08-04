$(document).ready(function() {
    
  $('#upload_logo').on('click', function(){
    $('#upload_logo_block').removeClass('displaynone').addClass('displayblock');
    $('.upload-fone').removeClass('displaynone').addClass('displayblock');
    
    $('body').addClass('blocked');
  });

  var close = function(){
    $('#upload_logo_block').removeClass('displaynblock').addClass('displaynone');
    $('.upload-fone').removeClass('displayblock').addClass('displaynone');
    $('body').removeClass('blocked');
    $('.upload_input').removeClass('displaynone').addClass('displayblock');
    $('.dropbox').removeClass('displayblock').addClass('displaynone');
    $('.photo_edit').removeClass('displayblock').addClass('displaynone');
  };

  $('.photo_close').on('click', function(){
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

  var photoID;
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
  $('button[aria-label="submit_photo"]').click(function(){
    $('#'+photoID+'_edited').cropper('getCroppedCanvas').toBlob(function (blob) {
      var formData = new FormData();
      formData.append('croppedImage', blob);

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
    minCropBoxHeight: 170
  });

});