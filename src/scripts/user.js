function togglePanel(type) {
  const panel = document.getElementById('userPanel-' + type);
  const overlay = document.getElementById('overlay-' + type);

  panel.classList.toggle('show');
  overlay.classList.toggle('show');
}

function closePanel(type) {
  const panel = document.getElementById('userPanel-' + type);
  const overlay = document.getElementById('overlay-' + type);

  panel.classList.remove('show');
  overlay.classList.remove('show');
}

// Fechar ao pressionar ESC (fecha ambos)
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closePanel('desktop');
    closePanel('mobile');
  }
});