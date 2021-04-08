var swalInit = swal.mixin({
   buttonsStyling: false,
   confirmButtonClass: 'btn bg-success',
   cancelButtonClass: 'btn bg-danger'
});

$(function() {
   $('.form-check-input-styled').uniform();
   $('.number').number(true);
   $('.select2').select2({
      placeholder: '-- Choose --'
   });

   setInterval(function() {
      var d    = new Date();
      var s    = d.getSeconds();
      var m    = d.getMinutes();
      var h    = d.getHours();
      $('#header-clock-realtime').text(('0' + h).substr(-2) + ':' + ('0' + m).substr(-2) + ':' + ('0' + s).substr(-2));
   }, 1000);

   $('.form-check-input-styled-primary').uniform({
      wrapperClass: 'border-primary-600 text-primary-800'
   });

   $('.form-check-input-styled-danger').uniform({
      wrapperClass: 'border-danger-600 text-danger-800'
   });

   $('.form-check-input-styled-success').uniform({
      wrapperClass: 'border-success-600 text-success-800'
   });

   $('.form-check-input-styled-warning').uniform({
      wrapperClass: 'border-warning-600 text-warning-800'
   });

   $('.form-check-input-styled-info').uniform({
      wrapperClass: 'border-info-600 text-info-800'
   });

   $('.form-check-input-styled-custom').uniform({
      wrapperClass: 'border-indigo-600 text-indigo-800'
   });
});

function loadingOpen(selector) {
   $(selector).waitMe({
      effect: 'timer',
      text: 'Please Wati ...',
      bg: 'rgba(255,255,255,0.7)',
      color: '#000',
      waitTime: -1,
      textPos: 'vertical'
   });
}

function notif(type, background, message) {
   new Noty({
      theme: ' alert ' + background + ' text-white alert-styled-left p-0',
      text: message,
      type: type,
      timeout: 2500
   }).show();
}

function loadingClose(selector) {
   $(selector).waitMe('hide');
}