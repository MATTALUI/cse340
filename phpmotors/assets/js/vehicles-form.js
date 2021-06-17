(() => {
  const useImageFilePreview = (inputSelector, previewContainerSelector) => {
    const imageInput = document.querySelector(inputSelector);
    imageInput.addEventListener('change', () => {
      const file = imageInput.files[0];
      if (file) {
        const src = URL.createObjectURL(file);
        const image = `<img src="${src}" alt="image preview" />`
        document.querySelector(previewContainerSelector).innerHTML = image;
      }
    });
  }

  useImageFilePreview('#image', '#inventoryPreview');
})();