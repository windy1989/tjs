$(function() {
   $('#show_password a').click(function() {
      if($('#show_password input').attr('type') == 'text') {
         $('#show_password input').attr('type', 'password');
         $('#show_password i').addClass('icon-eye-slash');
         $('#show_password i').removeClass('icon-eye');
      } else if($('#show_password input').attr('type') == 'password') {
         $('#show_password input').attr('type', 'text');
         $('#show_password i').removeClass('icon-eye-slash');
         $('#show_password i').addClass('icon-eye');
      }
   });

   $('.side-panel-trigger').off('click').on('click', function() {
      $body.toggleClass('side-panel-open');
      
      if($body.hasClass('device-touch') && $body.hasClass('side-push-panel')) {
         $body.toggleClass('ohidden');
      }

      return false;
   });
});

function loadingOpen(selector) {
   $(selector).waitMe({
      effect: 'ios',
      text: 'Please Wait ...',
      bg: 'rgba(255,255,255,0.7)',
      color: '#30302E',
      waitTime: -1,
      textPos: 'vertical'
   });
}

function loadingClose(selector) {
   $(selector).waitMe('hide');
}