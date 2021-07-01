Params-examples, abstract class SqlQuery 
``

     * @selectItems
     *
     * @param  array  $params = [
        'options' => [
            'skip' => 0,
            'limit' => 10,
            'sort' => [
                [
                    'col' => 'title',
                    'ascDesc' => 'asc',
                ],
                [
                    'col' => 'title2',
                    'ascDesc' => 'desc',
                ],
            ],
        ],
    ];



     * @createOneItem, @createManyItems, @updateOneItem, @updateManyItems, @createUpdateOneItem
     *
     * @param  array  $params = [
        'title' => 'Sunny',
        'ratioLikeDislike' => 3456.355555,
    ];



     * @deleteManyItems
     *
     * @param  array  $params = [
        'match' => [
            'channelId' => $channelId,
        ],
    ];

``