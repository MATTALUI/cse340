(() => {
  const changeImageFromThumbnail = event => {
    const img = event.target
    const tn = img.src;
    const target = tn.replace('-tn', '');
    Array.from(img.closest('.inventory__card').querySelector('.inventory__card-image').children).forEach(ele => {
      if (ele.src === target) {
        ele.classList.add('active');
      } else {
        ele.classList.remove('active');
      }
    });
  }

  document.querySelectorAll('.inventory__card-thumbnails > img')
    .forEach(e => e.addEventListener('click', changeImageFromThumbnail));
})();