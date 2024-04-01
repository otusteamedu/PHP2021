let buttons = document.getElementsByTagName('li')

for (let button of buttons) {
    button.addEventListener('click', () => {
        changeActionButton(button)
        changeForm(button)
        changeFormAction(button)
    })
}

function changeActionButton(button) {
    let currentActiveButton = document.getElementsByClassName('button_active')[0]

    button.classList.add('button_active')
    currentActiveButton.classList.remove('button_active')
}

function changeForm(button) {
    let action = button.dataset.action

    switch (action) {
        case 'search':
            let arHideFields = ['real_name', 'super_force']

            hideFields(arHideFields)
            changeFormButton('Найти')

            break

        case 'add':
            showAllFields()
            changeFormButton('Добавить')
    }
}

function hideFields(fields) {
    fields.forEach((fieldName) => {
        let field = document.getElementsByName(fieldName)[0],
            label = document.querySelector(`[for="${fieldName}"]`)

        field.style.display = 'none'
        label.style.display = 'none'
    })
}

function showAllFields() {
    let hideFields = document.querySelectorAll('[style="display: none;"]')

    hideFields.forEach((field) => {
        let label = field.previousElementSibling
        field.style.display = 'block'
        label.style.display = 'block'
    })
}

function changeFormButton(newName) {
    let formButton = document.querySelector('[type="submit"]')

    formButton.value = newName
}

function changeFormAction(button) {
    let action = button.dataset.action,
        actionInput = document.getElementById('action')

    actionInput.value = action
}