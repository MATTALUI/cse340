(() => {
  document.querySelector('nav button').addEventListener('click', () => {
    const navList = document.querySelector('nav ul');
    const hidden = navList.getAttribute('aria-hidden') === 'true';
    const nextLabel = hidden ? 'false' : 'true';
    const [addClass, removeClass] =
      hidden ? ['visible', 'hidden'] : ['hidden', 'visible'];
    navList.setAttribute('aria-hidden', nextLabel);
    navList.classList.add(addClass);
    navList.classList.remove(removeClass);
  });
})();