<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Domain\Catalog\Models\Brand;
use Illuminate\Database\Eloquent\Model;

use MoonShine\Fields\Image;
use MoonShine\Fields\Number;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;
use MoonShine\Handlers\ImportHandler;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Brand>
 */
class BrandResource extends ModelResource
{
    protected string $model = Brand::class;

    protected string $title = 'Бренды';

    public string $column = 'title';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Title')
                    ->showOnExport(),

                Image::make('Thumbnail')
                    ->dir('images/brands'),

                Switcher::make('On home page'),
                Number::make('Sorting')
                    ->min(1)
                    ->max(999),
            ]),
        ];
    }

    /**
     * @param Brand $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }

    public function search(): array
    {
        return ['id', 'title'];
    }

    public function filters(): array
    {
        return [
            Text::make('Title'),
        ];
    }

    public function import(): ?ImportHandler
    {
        return null;
    }
}
