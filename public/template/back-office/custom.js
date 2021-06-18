var swalInit = swal.mixin({
   buttonsStyling: false,
   confirmButtonClass: 'btn btn-primary',
   cancelButtonClass: 'btn btn-light'
});

lightbox.option({
   resizeDuration: 100,
   wrapAround: true
});

$(document).ready(function() {
   $('html').tooltip({selector: '[data-popup="tooltip"]'});
   $('.form-check-input-styled').uniform();
   $('.number').number(true);
   $('.select2').select2();
   $('.form-check-input-switch').bootstrapSwitch();

   setInterval(function() {
      var d = new Date();
      var s = d.getSeconds();
      var m = d.getMinutes();
      var h = d.getHours();
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

$.dateString = function(param) {
   var date   = new Date(param);
   var string = date.toDateString();
   var parse  = string.split(' ');

   return parse[1] + ' ' + parse[3];
};

function previewImage(event, selector) {
   if(event.files && event.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
         $(selector).attr('href', e.target.result);
         $(selector + ' img').attr('src', e.target.result);
      }
      
      reader.readAsDataURL(event.files[0]);
   }
}

function loadingOpen(selector) {
   $(selector).waitMe({
      effect: 'timer',
      text: 'Please Wait ...',
      bg: 'rgba(255,255,255,0.7)',
      color: '#000',
      waitTime: -1,
      textPos: 'vertical'
   });
}

function loadingClose(selector) {
   $(selector).waitMe('hide');
}

function notif(type, background, message) {
   new Noty({
      theme: ' alert ' + background + ' text-white alert-styled-left p-0',
      text: message,
      type: type,
      timeout: 2500
   }).show();
}

function select2ServerSide(selector, endpoint) {
   $(selector).select2({
      placeholder: '-- Choose --',
      minimumInputLength: 3,
      allowClear: true,
      cache: true,
      dropdownParent: $('body').parent(),
      ajax: {
         url: endpoint,
         type: 'POST',
         dataType: 'JSON',
         delay: 250,
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         data: function(params) {
            return {
               search: params.term
            };
         },
         processResults: function(data) {
            return {
               results: data.items
            }
         }
      }
   });
}