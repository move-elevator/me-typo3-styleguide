class TechnicalHeadline {
  constructor() {
    this.init()

    document.addEventListener("page:enter", () => {
      this.init()
    })
  }

  init() {
    if (this.cacheDom()) {
      this.generateTableOfContents()
    }
  }

  cacheDom() {
    const technicalHeadlineElement = document.querySelectorAll(
      ".me-typo3-styleguide-technical-headline"
    )
    const firstElement = technicalHeadlineElement[0]

    if (!technicalHeadlineElement.length || !firstElement) {
      return false
    }

    this.firstEl = firstElement
    this.technicalHeadlineEl = technicalHeadlineElement

    return true
  }

  generateTableOfContents() {
    if (document.querySelector("#me-typo3-styleguide-technical-headline-toc")) {
      return
    }
    const tocLabel = this.technicalHeadlineEl.item(0).getAttribute("data-label-toc")

    let html = `
      <div id="me-typo3-styleguide-technical-headline-toc" class="me-typo3-styleguide-technical-headline-toc">
        <h2 class="me-typo3-styleguide-technical-headline-toc__headline">${tocLabel}</h2>
        <ul class="me-typo3-styleguide-technical-headline-toc__items">
    `

    this.technicalHeadlineEl.forEach(headlineEl => {
      const firstChild = headlineEl.firstElementChild
      const tag = firstChild && firstChild.tagName ? firstChild.tagName.toLowerCase() : 'h2'
      const title = headlineEl.querySelector(".me-typo3-styleguide-technical-headline__title")
        ?.innerHTML
      html += `<li class="me-typo3-styleguide-technical-headline-toc__item ${tag}"><a class="me-typo3-styleguide-technical-headline-toc__link" href="#${headlineEl.getAttribute(
        "id"
      )}">${title}</a></li>`
    })
    html += "</ul></div>"

    this.firstEl?.insertAdjacentHTML("beforebegin", html)
  }
}

new TechnicalHeadline()
