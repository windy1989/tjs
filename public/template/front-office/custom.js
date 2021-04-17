function loadingOpen(selector) {
   $(selector).waitMe({
      effect: 'facebook',
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