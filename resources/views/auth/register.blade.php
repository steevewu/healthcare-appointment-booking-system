<!DOCTYPE html>

<html class="light" lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Đăng ký - Phenikaa Clinic</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#137fec",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101922",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        body {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
</head>

<body class="font-display bg-background-light dark:bg-background-dark">
    <div
        class="relative flex min-h-screen w-full flex-col items-center justify-center p-4 group/design-root overflow-x-hidden">
        <div class="w-full max-w-lg">
            <div class="flex flex-col items-center justify-center pb-8">
                <a href="{{ route('welcome') }}">
                    <img alt="Phenikaa Clinic logo" class="h-12 w-auto" data-alt="Phenikaa Clinic logo"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDszAzFwlG9kmhfgwANxnp8j_l4oFv4r45_7Ib0_f9nfbGYcGkR51NEL4v1d0UoByb2aOBIelBfHPoI0yxQO0ULNEPmKyLqiVLTwkxutGmgllg7oIudwza8szCPY_72rP9b1pd9DbrMiWrN84-Yf7_U4olGc6LWFFRR9lPq8kj0u0Fd3I_-ABz4ShIW4KwlZNU2L-G3QQ4KoTAfTx8od6As6BQAWmnpTH9-xIQoy3WwNDSw011oki3m0iGWadObH2BM3bQpEm4MJ0c" />
                </a>
            </div>
            <div
                class="rounded-xl border border-gray-200/80 bg-white p-6 sm:p-10 shadow-sm dark:border-gray-800 dark:bg-background-dark">
                <div class="flex flex-col gap-3 pb-6">
                    <p class="text-3xl font-black leading-tight tracking-tight text-[#111418] dark:text-white">Tạo tài
                        khoản mới</p>
                    <p class="text-base font-normal leading-normal text-[#617589] dark:text-gray-400">Nhanh chóng đặt
                        lịch khám và quản lý sức khỏe của bạn.</p>
                </div>
                <form action="{{ route('register') }}" method="post" class="flex flex-col gap-5">
                    @csrf
                    <label class="flex flex-col">
                        <p class="pb-2 text-sm font-medium leading-normal text-[#111418] dark:text-gray-300">
                            {{ __('filament::resources.fullname') }}
                        </p>
                        <input
                            class="form-input flex h-12 w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg border border-[#dbe0e6] bg-white p-[15px] text-base font-normal leading-normal text-[#111418] placeholder:text-[#617589] focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500"
                            autofocus required type="text" value="{{ old('name') }}" name="name" />
                    </label>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />

                    <label class="flex flex-col">
                        <p class="pb-2 text-sm font-medium leading-normal text-[#111418] dark:text-gray-300">
                            {{ __('filament::resources.dob') }}</p>
                        <input
                            class="form-input flex h-12 w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg border border-[#dbe0e6] bg-white p-[15px] text-base font-normal leading-normal text-[#111418] placeholder:text-[#617589] focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500"
                            type="date" required value="{{ old('dob') }}" name="dob" />
                    </label>
                    <x-input-error :messages="$errors->get('dob')" class="mt-2" />
                    <label class="flex flex-col">
                        <p class="pb-2 text-sm font-medium leading-normal text-[#111418] dark:text-gray-300">
                            {{ __('filament::resources.email') }}</p>
                        <input
                            class="form-input flex h-12 w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg border border-[#dbe0e6] bg-white p-[15px] text-base font-normal leading-normal text-[#111418] placeholder:text-[#617589] focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500"
                            required type="email" value="{{ old('email') }}" name="email" />
                    </label>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    <label class="flex flex-col min-w-40 flex-1 gap-2">
                        <p class="text-gray-800 dark:text-gray-200 text-base font-medium leading-normal font-display">
                            {{ __('Password') }}</p>
                        <input
                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-gray-100 focus:outline-0 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-14 placeholder:text-gray-500 dark:placeholder:text-gray-400 p-[15px] text-base font-normal leading-normal font-display"
                            name="password" required type="password" />
                    </label>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    <label class="flex flex-col min-w-40 flex-1 gap-2">
                        <p class="text-gray-800 dark:text-gray-200 text-base font-medium leading-normal font-display">
                            {{ __('Confirm Password') }}</p>
                        <input
                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-gray-100 focus:outline-0 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-14 placeholder:text-gray-500 dark:placeholder:text-gray-400 p-[15px] text-base font-normal leading-normal font-display"
                            name="password_confirmation" required type="password" />
                    </label>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    <button
                        class="flex h-12 w-full items-center justify-center rounded-lg bg-primary px-6 py-3 text-base font-bold text-white transition-all duration-300 hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary/50"
                        type="submit">Đăng ký</button>
                </form>
                <div class="pt-6 text-center">
                    <p class="text-sm font-normal text-[#617589] dark:text-gray-400">
                        Đã có tài khoản?
                        <a class="font-semibold text-primary hover:underline" href="{{route(name: 'login')}}">Đăng nhập ngay</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
