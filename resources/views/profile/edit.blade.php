@extends('layouts.app')

@section('title', 'Редактировать профиль')

@section('content')
    <main class="py-16 lg:py-20">
        <div class="container">

            <section>
                <!-- Section heading -->
                <h1 class="mb-8 text-lg lg:text-[42px] font-black text-center">Редактировать профиль</h1>

                <div class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-3">
                        @method('PUT')
                        @csrf

                        <x-forms.text-input
                                name="name"
                                type="text"
                                placeholder="Имя и фамилия"
                                value="{{ $user->name ?? old('name') }}"
                                :isError="$errors->has('name')"
                        >
                        </x-forms.text-input>

                        @error('name')
                        <x-forms.error>
                            {{ $message }}
                        </x-forms.error>
                        @enderror

                        <x-forms.text-input
                                name="email"
                                type="email"
                                placeholder="E-mail"
                                value="{{ $user->email ?? old('email') }}"
                                :isError="$errors->has('email')"
                        >
                        </x-forms.text-input>

                        @error('email')
                        <x-forms.error>
                            {{ $message }}
                        </x-forms.error>
                        @enderror

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <x-forms.text-input
                                        name="password"
                                        type="password"
                                        placeholder="Пароль"
                                        value=""
                                        :isError="$errors->has('password')"
                                >
                                </x-forms.text-input>

                                @error('password')
                                <x-forms.error>
                                    {{ $message }}
                                </x-forms.error>
                                @enderror
                            </div>
                            <div>
                                <x-forms.text-input
                                        name="password_confirmation"
                                        type="password"
                                        placeholder="Повторно пароль"
                                        value=""
                                        :isError="$errors->has('password_confirmation')"
                                >
                                </x-forms.text-input>

                                @error('password_confirmation')
                                <x-forms.error>
                                    {{ $message }}
                                </x-forms.error>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="w-full btn btn-pink">Сохранить</button>
                    </form>
                </div>
            </section>

        </div>
    </main>
@endsection