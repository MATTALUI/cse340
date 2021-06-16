(() => {
  const addSafeListener = (selector, event, handler) => {
    if (document.querySelector(selector)) {
      document.querySelector(selector).addEventListener(event, handler);
    }
  }

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

  // Helper to make the labels for file inputs act as buttons
  const useFileInputButtonLabels = () => document
    .querySelectorAll('input[type="file"]')
    .forEach(ele => 
      document.querySelector(`label[for="${ele.getAttribute('id')}"]`).classList.add('button')
    );

  // Helper that allows users to use labels as the buttons for file inputs
  const manageFileInputLabels = (event) => {
    const file = event.target.files[0];
    const name = file.name;
    const label = document.querySelector(`label[for="${event.target.getAttribute('id')}"]`);
    label.innerHTML = name;
  }
  

  addSafeListener('nav button', 'click', toggleNavigation);
  addSafeListener('input[type="file"]', 'change', manageFileInputLabels);
  setRequiredFieldLabels();
  useFileInputButtonLabels();
})();