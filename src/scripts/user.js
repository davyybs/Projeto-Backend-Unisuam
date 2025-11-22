function togglePanel() {
  const panel = document.getElementById('userPanel');
  const overlay = document.getElementById('overlay');
  
  panel.classList.toggle('show');
  overlay.classList.toggle('show');
}

function closePanel() {
  const panel = document.getElementById('userPanel');
  const overlay = document.getElementById('overlay');
  
  panel.classList.remove('show');
  overlay.classList.remove('show');
}

// Fechar ao pressionar ESC
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closePanel();
  }
});
