let videoFieldsBlock = document.getElementsByClassName('video-fields')[0],
    nameFields = document.getElementsByClassName('name-field')[0],
    actionInput = document.getElementsByName('action')[0],
    selectTitle = document.getElementsByTagName('label')[0],
    question = document.getElementsByClassName('question')[0],
    idField = document.getElementsByClassName('id-field')[0]

function changeActionButton(currentElem) {
    let activeButton = document.getElementsByClassName('red-button_active')[0]

    activeButton.classList.remove('red-button_active')
    currentElem.classList.add('red-button_active')
}

function changeAction(action) {
    actionInput.value = action
}

function clearFieldsInBlock(block) {
    let videoFields = block.querySelectorAll('input')

    for (let field of videoFields) {
        field.value = ''
    }
}

function showTypeAndIdFields() {
    videoFieldsBlock.style.display = 'none'
    indexSelect.style.display = 'block'
    selectTitle.style.display = 'block'
    idField.style.display = 'none'
    question.style.display = 'none'
    nameFields.style.display = 'block'

    clearFieldsInBlock(videoFieldsBlock)
}

function switchHandler(switchType) {
    switch (switchType) {
        case 'youtube_video':
            videoFieldsBlock.style.display = 'block'

            break
        case 'youtube_channel':
            videoFieldsBlock.style.display = 'none'

            clearFieldsInBlock(videoFieldsBlock)

            break

        case 'search':
            showTypeAndIdFields()

            break

        case 'add':
            indexSelect.value = 'youtube_channel'
            indexSelect.style.display = 'block'
            selectTitle.style.display = 'block'
            idField.style.display = 'block'
            question.style.display = 'none'
            idField.style.display = 'block'
            nameFields.style.display = 'block'

            break
    }
}

$('[data-action]').on('click', function () {
    changeAction(this.dataset.action)
    changeActionButton(this)
    switchHandler(this.dataset.action)
})
