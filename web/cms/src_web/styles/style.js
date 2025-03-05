$('.info').hover(
  function() {
    let top = $(this).offset().top + $(this).height();
    let left = $(this).offset().left;
    let data = $(this).data('modal-text');

    let div = document.createElement('div');
    div.id = 'modal';
    $(div).css('top', top);
    $(div).css('left', left);
    $(div).html(data);
    $('body').append(div);
  },
  function() {
    $('#modal').remove();
  });
