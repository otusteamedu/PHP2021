$("#statisticsForm select[name=type]").change(function () {
    const typeValue = $(this).val();
    const minTopValue = 1;
    placeHolderValue = 'Поиск ...';
    let inputType = 'text';

    const queryField = $("#statisticsForm input[name=query]");

    switch (typeValue) {
        case 'sum':
            queryField.removeAttr('min');
            break;
        case 'top':
            queryField.attr('min', minTopValue);
            placeHolderValue = 'Топ скольки каналов нужно вывести (минимум 1)';
            inputType = 'number';
            break;
    }
    queryField.attr('placeholder', placeHolderValue);
    queryField.attr('type', inputType);
    queryField.val('');
});
