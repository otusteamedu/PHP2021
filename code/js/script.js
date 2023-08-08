let searchButton = document.getElementsByClassName('search')[0],
    addButton = document.getElementsByClassName('add')[0],
    actionField = document.getElementById('action'),
    deleteButton = document.getElementsByClassName('delete')[0],
    deleteQuestion = document.getElementsByTagName('h3')[0],
    arFieldsForHide = ['priority', 'event']

function prepareFieldForSearch() {
    changeActiveButton(this)
    changeElementVisible(arFieldsForHide, 'none')
    changeRequired(arFieldsForHide)

    if (deleteQuestion.style.display === 'block') {
        changeElementVisible(['conditions'], 'block')
        changeRequired(['conditions'])
    }

    actionField.value = 'search'
}

function changeActiveButton(activatedButton) {
    let currentActiveButton = document.getElementsByClassName('button_active')[0]

    currentActiveButton.classList.remove('button_active')
    activatedButton.classList.add('button_active')
}

function prepareFieldsForAdd() {
    changeRequired(arFieldsForHide)
    changeActiveButton(this)
    changeElementVisible(arFieldsForHide, 'block')

    actionField.value = 'add'
}

function changeElementVisible(elements, visibleStatus) {
    elements.forEach((elemName) => {
        let domElem = document.getElementById(elemName),
            elemLabel = document.querySelector(`[for="${elemName}"]`)

        domElem.style.display = visibleStatus
        elemLabel.style.display = visibleStatus
        domElem.value = ''
    })
}

function prepareForDelete() {
    deleteQuestion.style.display = 'block'
    actionField.value = 'delete'
    arFieldsForHide.push('conditions')

    changeElementVisible(arFieldsForHide, 'none')
    changeActiveButton(this)
    changeRequired(arFieldsForHide)
}

function changeRequired(arElements) {
    arElements.forEach((elem) => {
        let domElem = document.getElementById(elem)
        console.log(domElem)

        if(domElem.hasAttribute('required')) {
            domElem.removeAttribute('required')
        } else {
            domElem.setAttribute('required', '')
        }
    })
}

searchButton.addEventListener('click', prepareFieldForSearch)
addButton.addEventListener('click', prepareFieldsForAdd)
deleteButton.addEventListener('click', prepareForDelete)