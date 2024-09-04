<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Model;

use MoonShine\Decorations\Tab;
use MoonShine\Fields\Image;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Relationships\BelongsToMany;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Product>
 */
class ProductResource extends ModelResource
{
    protected string $model = Product::class;

    protected string $title = 'Продукция';

    protected array $with = [
        'brand',
        'categories',
        'properties',
        'optionValues'
    ];

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                Tab::make('Basic', [
                    ID::make()->sortable(),
                    Text::make('Title'),
                    BelongsTo::make('Brand'),

                    Text::make(
                        'Price',
//                        resource: function ($item) {
//                            return $item->price->raw();
//                        }
                    ),

                    Image::make('Thumbnail')
                        ->dir('images/products'),
                ]),

                Tab::make('Categories', [
                    BelongsToMany::make('Categories')
                        ->hideOnIndex(),
                ]),

                Tab::make('Properties', [
                    BelongsToMany::make('Properties')
                        ->fields([
                            Text::make('Value')
                        ])
                        ->hideOnIndex(),
                ]),

//                Tab::make('Options', [
//                    BelongsToMany::make('OptionValues', resource: 'title')
//                        ->fields([
//                            Text::make('Value')
//                        ]),
//                ]),
            ]),
        ];
    }

    /**
     * @param Product $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }

    public function filters(): array
    {
        return [
            BelongsTo::make('Brand')
                ->searchable(),
        ];
    }
}
