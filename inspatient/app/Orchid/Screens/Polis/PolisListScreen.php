<?php

namespace App\Orchid\Screens\Polis;

use App\Models\Polis;
use App\Models\PolisView;
use App\Orchid\Layouts\Polis\PolisEditLayout;
use App\Orchid\Layouts\Polis\PolisImportLayout;
use App\Orchid\Layouts\Polis\PolisListTable;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class PolisListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Страховые полиса';
    public $description = 'Список страховых полисов';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        //    return ['polis' => Polis::with('patient', 'insurance')->filters()->paginate(15)];
        return ['polis' => PolisView::filters()->paginate(15)];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->route('platform.polis.create'),
        ];

    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            PolisListTable::class,
            Layout::modal('editPolis', PolisEditLayout::class)
                ->async('asyncGetPolis'),

        ];
    }

    /**
     * @param Polis $user
     *
     * @return array
     */
    public function asyncGetPolis(Polis $polis): array
    {
        return [
            'polis' => $polis,
        ];
    }


}
