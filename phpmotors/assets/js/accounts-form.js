(() => {
  const newPasswordInput = document.querySelector('#newPassword');
  const confirmPasswordInput = document.querySelector('#confirmPassword');
  const comparePasswordConfirmation = (event, ignoreLengths = false) => {
    const newPassword = newPasswordInput.value;
    const confirmPassword = confirmPasswordInput.value;
    const readyToCompare = ignoreLengths || (newPassword.length && confirmPassword.length);

    if (readyToCompare && newPassword !== confirmPassword) {
      document.querySelector('#messages-container').innerHTML = '<p class="message-error">New passwords do not match.</p>';
      event.preventDefault();
      return false
    } else {
      document.querySelector('#messages-container').innerHTML = '';
    }
  }

  newPasswordInput.addEventListener('change', comparePasswordConfirmation);
  confirmPasswordInput.addEventListener('change', comparePasswordConfirmation);
  document.forms[1].addEventListener('submit', e => comparePasswordConfirmation(e, true));
})();