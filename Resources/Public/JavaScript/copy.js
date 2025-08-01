class Copy {
  constructor() {
    this.init();
  }

  init() {
    document.querySelectorAll('.typo3-styleguide__element[data-copy]').forEach(el => {
      el.addEventListener('click', () => this.copyToClipboard(el));
    });
  }

  copyToClipboard(el) {
    const value = el.getAttribute('data-copy');
    if (!value) return;

    navigator.clipboard.writeText(value).then(() => {
      this.showCopiedHint(el);
    });
  }

  showCopiedHint(el) {
    let hint = document.createElement('div');
    hint.textContent = 'Copy';
    hint.classList.add('copy-hint');

    el.style.position = 'relative';
    el.appendChild(hint);

    setTimeout(() => {
      hint.remove();
    }, 1200);
  }
}

new Copy();
