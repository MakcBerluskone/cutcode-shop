<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Domain\Catalog\ViewModels\BrandViewModel;
use Domain\Catalog\ViewModels\CategoryViewModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final class HomeController extends Controller
{
    public function __invoke(): Application|Factory|View
    {
        $categories = CategoryViewModel::make()
            ->homePage();

        $products = Product::query()
            ->homePage()
            ->get();

        $brands = BrandViewModel::make()
            ->homePage();

        return view('index', compact(['categories', 'products', 'brands']));
    }
}
