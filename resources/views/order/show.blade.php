@extends('layouts.app')

@section('title', 'Оформление заказа')

@section('content')
    <main class="py-16 lg:py-20">
        <div class="container">

            <!-- Breadcrumbs -->
            <ul class="breadcrumbs flex flex-wrap gap-y-1 gap-x-4 mb-6">
                <li><a href="{{ route('home') }}" class="text-body hover:text-pink text-xs">Главная</a></li>
                <li><a href="{{ route('orders') }}" class="text-body hover:text-pink text-xs">Мои заказы</a></li>
                <li><span class="text-body text-xs">Заказ №{{ $order->id }}</span></li>
            </ul>

            <section>
                <!-- Section heading -->
                <div class="flex flex-col md:flex-row md:items-center gap-3 md:gap-6 mb-8">
                    <h1 class="pb-4 md:pb-0 text-lg lg:text-[42px] font-black">Заказ №{{ $order->id }}</h1>
                    <div class="px-6 py-3 rounded-lg bg-purple">{{ $order->status->humanValue() }}</div>
                    <div class="px-6 py-3 rounded-lg bg-card">Дата
                        заказа: {{ $order->created_at->format('d.m.Y') }}</div>
                </div>

                <!-- Message -->
                <div class="md:hidden py-3 px-6 rounded-lg bg-pink text-white">Таблицу можно пролистать вправо →</div>

                <!-- Adaptive table -->
                <div class="overflow-auto">
                    <table class="min-w-full border-spacing-y-4 text-white text-sm text-left"
                           style="border-collapse: separate">
                        <thead class="text-xs uppercase">
                        <th scope="col" class="py-3 px-6">Товар</th>
                        <th scope="col" class="py-3 px-6">Цена</th>
                        <th scope="col" class="py-3 px-6">Количество</th>
                        <th scope="col" class="py-3 px-6">Сумма</th>
                        </thead>
                        <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td scope="row" class="py-4 px-6 rounded-l-2xl bg-card">
                                    <div class="flex flex-col lg:flex-row min-w-[200px] gap-2 lg:gap-6">
                                        <div class="shrink-0 overflow-hidden w-[64px] lg:w-[84px] h-[64px] lg:h-[84px] rounded-2xl">
                                            <img src="{{ $item->product->makeThumbnail('84x84') }}"
                                                 class="object-cover w-full h-full"
                                                 alt="{{ $item->product->title }}">
                                        </div>
                                        <div class="py-3">
                                            <h4 class="text-xs sm:text-sm xl:text-md font-bold">
                                                <a href="{{ route('product', $item->product->slug) }}"
                                                   class="inline-block text-white hover:text-pink">{{ $item->product->title }}</a>
                                            </h4>
                                            <ul class="space-y-1 mt-2 text-xs">
                                                <li class="text-body">Цвет: Белый</li>
                                                <li class="text-body">Размер (хват): Средний</li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6 bg-card">
                                    <div class="font-medium whitespace-nowrap">{{ $item->price }}</div>
                                </td>
                                <td class="py-4 px-6 bg-card">{{ $item->quantity }}</td>
                                <td class="py-4 px-6 bg-card rounded-r-2xl">
                                    <div class="font-medium whitespace-nowrap">{{ $item->amount }}</div>
                                </td>
                            </tr>
                        @endforeach
                        {{--                        <tr>--}}
                        {{--                            <td scope="row" class="py-4 px-6 rounded-l-2xl bg-card">--}}
                        {{--                                <div class="flex flex-col lg:flex-row min-w-[200px] gap-2 lg:gap-6">--}}
                        {{--                                    <div class="shrink-0 overflow-hidden w-[64px] lg:w-[84px] h-[64px] lg:h-[84px] rounded-2xl">--}}
                        {{--                                        <img src="../../images/products/5.jpg" class="object-cover w-full h-full" alt="SteelSeries Arctis 5 White 2019 Edition">--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="py-3">--}}
                        {{--                                        <h4 class="text-xs sm:text-sm xl:text-md font-bold"><a href="product.html" class="inline-block text-white hover:text-pink">SteelSeries Arctis 5 White 2019 Edition</a></h4>--}}
                        {{--                                        <ul class="space-y-1 mt-2 text-xs">--}}
                        {{--                                            <li class="text-body">Цвет: Белый</li>--}}
                        {{--                                        </ul>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </td>--}}
                        {{--                            <td class="py-4 px-6 bg-card">--}}
                        {{--                                <div class="font-medium whitespace-nowrap">58 730 ₽</div>--}}
                        {{--                            </td>--}}
                        {{--                            <td class="py-4 px-6 bg-card">1</td>--}}
                        {{--                            <td class="py-4 px-6 bg-card rounded-r-2xl">--}}
                        {{--                                <div class="font-medium whitespace-nowrap">58 730 ₽</div>--}}
                        {{--                            </td>--}}
                        {{--                        </tr>--}}
                        {{--                        <tr>--}}
                        {{--                            <td scope="row" class="py-4 px-6 rounded-l-2xl bg-card">--}}
                        {{--                                <div class="flex flex-col lg:flex-row min-w-[200px] gap-2 lg:gap-6">--}}
                        {{--                                    <div class="shrink-0 overflow-hidden w-[64px] lg:w-[84px] h-[64px] lg:h-[84px] rounded-2xl">--}}
                        {{--                                        <img src="../../images/products/9.jpg" class="object-cover w-full h-full" alt="Hator Hypersport V2 (HTC-948) Black/White">--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="py-3">--}}
                        {{--                                        <h4 class="text-xs sm:text-sm xl:text-md font-bold"><a href="product.html" class="inline-block text-white hover:text-pink">Hator Hypersport V2 (HTC-948) Black/White</a></h4>--}}
                        {{--                                        <ul class="space-y-1 mt-2 text-xs">--}}
                        {{--                                            <li class="text-body">Цвет: Черно-белый</li>--}}
                        {{--                                        </ul>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </td>--}}
                        {{--                            <td class="py-4 px-6 bg-card">--}}
                        {{--                                <div class="font-medium whitespace-nowrap">142 800 ₽</div>--}}
                        {{--                            </td>--}}
                        {{--                            <td class="py-4 px-6 bg-card">1</td>--}}
                        {{--                            <td class="py-4 px-6 bg-card rounded-r-2xl">--}}
                        {{--                                <div class="font-medium whitespace-nowrap">142 800 ₽</div>--}}
                        {{--                            </td>--}}
                        {{--                        </tr>--}}
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-col-reverse md:flex-row md:items-center md:justify-between mt-8 gap-6">
                    <div class="flex md:justify-end">
                        <a href="{{ route('orders') }}" class="btn btn-pink">←&nbsp; Вернуться назад</a>
                    </div>
                    <div class="text-[32px] font-black md:text-right">Итого: 289 330 ₽</div>
                </div>

            </section>

        </div>
    </main>
@endsection
