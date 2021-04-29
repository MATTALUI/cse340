(() => {
  document.querySelector('nav button').addEventListener('click', () => {
    const navList = document.querySelector('nav ul');
    const hidden = navList.getAttribute('aria-hidden') === 'true';
    navList.setAttribute('aria-hidden', hidden ? 'false' : 'true');
    navList.classList.add(hidden ? 'visible' : 'hidden');
    navList.classList.remove(hidden ? 'hidden' : 'visible');
  });
})();