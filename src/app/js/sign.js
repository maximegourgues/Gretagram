
var modal = document.querySelector('.modal');

  document.getElementById('inscription').addEventListener('click', function() {
    modal.classList.add('modal-active');
  });
  document.querySelector('.close').addEventListener('click', function() {
    modal.classList.remove('modal-active');
  });
