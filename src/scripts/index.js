document.addEventListener("DOMContentLoaded", function () {

  const isTouchDevice = "ontouchstart" in window || navigator.maxTouchPoints > 0;


  document.querySelectorAll('.livros-container-wrapper').forEach(wrapper => {
    const container = wrapper.querySelector('.livros-container');
    const btnLeft = wrapper.querySelector('.seta-esquerda');
    const btnRight = wrapper.querySelector('.seta-direita');

    if (!btnLeft || !btnRight) return;

    function getScrollAmount() {
      const primeiro = container.querySelector('.livro-card');
      return primeiro ? primeiro.getBoundingClientRect().width + 20 : 380;
    }

    btnLeft.addEventListener('click', () => container.scrollBy({ left: -getScrollAmount(), behavior: 'smooth' }));
    btnRight.addEventListener('click', () => container.scrollBy({ left: getScrollAmount(), behavior: 'smooth' }));

    if (isTouchDevice) {
      let touchStartX = 0;
      container.addEventListener('touchstart', e => touchStartX = e.touches[0].clientX);
      container.addEventListener('touchend', e => {
        const distance = touchStartX - e.changedTouches[0].clientX;
        if (Math.abs(distance) > 50) {
          container.scrollBy({ left: distance > 0 ? getScrollAmount() : -getScrollAmount(), behavior: 'smooth' });
        }
      });
    } else {
      container.addEventListener('mousedown', e => e.preventDefault());
      container.style.userSelect = "none";
    }

    function updateSetas() {
      const maxScroll = container.scrollWidth - container.clientWidth;
      btnLeft.style.opacity = container.scrollLeft <= 10 ? '0.5' : '1';
      btnLeft.disabled = container.scrollLeft <= 10;
      btnRight.style.opacity = container.scrollLeft >= maxScroll - 10 ? '0.5' : '1';
      btnRight.disabled = container.scrollLeft >= maxScroll - 10;
    }

    container.addEventListener('scroll', updateSetas);
    window.addEventListener('resize', updateSetas);
    setTimeout(updateSetas, 200);
  });

 
  document.querySelectorAll(".saiba-mais").forEach(btn => {
    btn.addEventListener("click", () => {
      const id = btn.getAttribute("data-id");
      fetch("get_livro.php?id=" + id)
        .then(res => res.json())
        .then(livro => {
          document.getElementById("modalTitulo").innerText = livro.titulo;
          document.getElementById("modalAutor").innerText = livro.autor;
          document.getElementById("modalGenero").innerText = livro.genero;
          document.getElementById("modalAno").innerText = livro.ano_publicacao ?? 'N/A';
          document.getElementById("modalPaginas").innerText = livro.paginas ?? 'N/A';
          document.getElementById("modalEdicao").innerText = livro.edicao ?? 'N/A';
          document.getElementById("modalQuantidade").innerText = livro.quantidade ?? 'N/A';
          document.getElementById("modalDescricao").innerText = livro.descricao;
          document.getElementById("modalCapa").src = livro.capa;
          document.getElementById("btnAlugar").href = "alugar.php?id=" + livro.id;

          new bootstrap.Modal(document.getElementById("modalLivro")).show();
        });
    });
  });

});

document.getElementById("btnAlugar").addEventListener("click", function(e){
    e.preventDefault();

    const blur = document.getElementById("blurAluga");
    const msg = document.getElementById("mensagemAluga");

    blur.style.display = "block";
    msg.style.display = "block";

    setTimeout(() => {
        blur.style.display = "none";
        msg.style.display = "none";
    }, 2000);
});
document.querySelectorAll(".saiba-mais").forEach(btn => {
  btn.addEventListener("click", () => {
    document.getElementById("modalTitulo").innerText = btn.dataset.titulo;
    document.getElementById("modalAutor").innerText = btn.dataset.autor;
    document.getElementById("modalAno").innerText = btn.dataset.ano;
    document.getElementById("modalGenero").innerText = btn.dataset.genero;
    document.getElementById("modalPaginas").innerText = btn.dataset.paginas ?? 'N/A';
    document.getElementById("modalEdicao").innerText = btn.dataset.edicao ?? 'N/A';
    document.getElementById("modalQuantidade").innerText = btn.dataset.quantidade ?? 'N/A';
    document.getElementById("modalDescricao").innerText = btn.dataset.descricao;
    document.getElementById("modalCapa").src = btn.dataset.capa;
    document.getElementById("btnAlugar").href = "alugar.php?id=" + btn.dataset.id;

    let modal = new bootstrap.Modal(document.getElementById("modalLivro"));
    modal.show();
  });
});




