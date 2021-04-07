$(function() {
   setInterval(function() {
      var d    = new Date();
      var s    = d.getSeconds();
      var m    = d.getMinutes();
      var h    = d.getHours();
      $('#header-clock-realtime').text(('0' + h).substr(-2) + ':' + ('0' + m).substr(-2) + ':' + ('0' + s).substr(-2));
   }, 1000);
});

function googleTranslateElementInit() {
   new google.translate.TranslateElement({
      pageLanguage: 'en',
      layout: google.translate.TranslateElement.InlineLayout.SIMPLE
   }, 'google_translate_element');
}

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

function loadingClose(selector) {
   $(selector).waitMe('hide');
}