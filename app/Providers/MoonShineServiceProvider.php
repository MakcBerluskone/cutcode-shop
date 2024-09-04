<?php

declare(strict_types=1);

namespace App\Providers;

use App\MoonShine\Resources\BrandResource;
use App\MoonShine\Resources\CategoryResource;
use App\MoonShine\Resources\OptionResource;
use App\MoonShine\Resources\OrderResource;
use App\MoonShine\Resources\ProductResource;
use App\MoonShine\Resources\PropertyResource;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;
use MoonShine\Contracts\Resources\ResourceContract;
use MoonShine\Menu\MenuElement;
use MoonShine\Pages\Page;
use Closure;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    /**
     * @return list<ResourceContract>
     */
    protected function resources(): array
    {
        return [];
    }

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [];
    }

    /**
     * @return Closure|list<MenuElement>
     */
    protected function menu(): array
    {
        return [
            MenuItem::make(
                'Заказы',
                new OrderResource(),
                'heroicons.gift'
            ),

            MenuGroup::make(
                'Продукция',
                [
                    MenuItem::make(
                        'Товары',
                        new ProductResource(),
                        'heroicons.gift'
                    ),
                    MenuItem::make(
                        'Бренды',
                        new BrandResource(),
                        'heroicons.outline.users'
                    ),
                    MenuItem::make(
                        'Категории',
                        new CategoryResource(),
                        'heroicons.outline.rectangle-group'
                    ),
                    MenuItem::make(
                        'Свойства',
                        new PropertyResource(),
                        'heroicons.outline.users'
                    ),
                    MenuItem::make(
                        'Опции',
                        new OptionResource(),
                        'heroicons.outline.users'
                    ),
                ],
                'heroicons.home'
            ),

            MenuGroup::make(
                static fn() => __('moonshine::ui.resource.system'),
                [
                    MenuItem::make(
                        static fn() => __('moonshine::ui.resource.admins_title'),
                        new MoonShineUserResource()
                    ),
//                    MenuItem::make(
//                        static fn() => __('moonshine::ui.resource.role_title'),
//                        new MoonShineUserRoleResource()
//                    ),
                ],
                'heroicons.outline.tv'
            ),
        ];
    }

    /**
     * @return Closure|array{css: string, colors: array, darkColors: array}
     */
    protected function theme(): array
    {
        return [];
    }
}
