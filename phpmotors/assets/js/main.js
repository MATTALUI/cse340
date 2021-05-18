(() => {
  const toggleNavigation = () => {
    const navList = document.querySelector('nav ul');
    const hidden = navList.getAttribute('aria-hidden') === 'true';
    navList.setAttribute('aria-hidden', hidden ? 'false' : 'true');
    navList.classList.add(hidden ? 'visible' : 'hidden');
    navList.classList.remove(hidden ? 'hidden' : 'visible');
  };

  // Helper to make sure that any labels for required inputs have required class
  const setRequiredFieldLabels = () => document
    .querySelectorAll('input[required]')
    .forEach(ele => 
      document.querySelector(`label[for="${ele.getAttribute('id')}"]`).classList.add('required')
    );
  

  document.querySelector('nav button').addEventListener('click', toggleNavigation);
  setRequiredFieldLabels();
})();