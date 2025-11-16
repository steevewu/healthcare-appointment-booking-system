<!DOCTYPE html>

<html class="light" lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Đăng nhập - Phenikaa Clinic</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&amp;display=swap"
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
        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24
        }
    </style>
</head>

<body class="font-display bg-background-light dark:bg-background-dark">
    <div class="relative flex min-h-screen w-full flex-col group/design-root">
        <div class="layout-container flex h-full grow flex-col">
            <main class="flex flex-1">
                <div class="flex w-full flex-wrap">
                    <div class="flex w-full flex-col md:w-1/2">
                        <div class="flex flex-col justify-center px-6 sm:px-12 md:px-16 lg:px-24 xl:px-32 py-10 flex-1">
                            <div class="flex flex-col gap-8 w-full max-w-md mx-auto">
                                <div class="flex flex-col items-start gap-2">
                                    <a class="flex items-center gap-2 text-xl font-bold text-gray-800 dark:text-white"
                                        href="{{ route('welcome') }}">
                                        <svg class="h-8 w-auto text-primary" fill="currentColor" viewbox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15v-4H8v-2h3V7h2v4h3v2h-3v4h-2z">
                                            </path>
                                        </svg>
                                        <span class="font-display">Phenikaa Clinic</span>
                                    </a>
                                </div>
                                <div class="flex flex-col gap-3">
                                    <p
                                        class="text-gray-900 dark:text-gray-50 text-4xl font-black leading-tight tracking-[-0.033em] font-display">
                                        Chào mừng trở lại</p>
                                    <p
                                        class="text-gray-600 dark:text-gray-400 text-base font-normal leading-normal font-display">
                                        Vui lòng nhập thông tin để đăng nhập.</p>
                                </div>
                                <form action='{{ route('login') }}' method='post' class="flex flex-col gap-6">
                                    @csrf
                                    <div class="flex flex-col gap-4">
                                        <label class="flex flex-col min-w-40 flex-1 gap-2">
                                            <p
                                                class="text-gray-800 dark:text-gray-200 text-base font-medium leading-normal font-display">
                                                {{ __('filament::resources.email') }}</p>
                                            <input
                                                class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-gray-100 focus:outline-0 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-14 placeholder:text-gray-500 dark:placeholder:text-gray-400 p-[15px] text-base font-normal leading-normal font-display"
                                                name="email" required autofocus />
                                        </label>
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                        <label class="flex flex-col min-w-40 flex-1 gap-2">
                                            <p
                                                class="text-gray-800 dark:text-gray-200 text-base font-medium leading-normal font-display">
                                                {{ __('Password') }}</p>
                                            <input
                                                class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-gray-100 focus:outline-0 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-14 placeholder:text-gray-500 dark:placeholder:text-gray-400 p-[15px] text-base font-normal leading-normal font-display"
                                                name="password" required type="password" />
                                        </label>
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        <a class="text-primary text-sm font-medium hover:underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary rounded-sm"
                                            href="{{ route('password.request') }}">Quên mật khẩu?</a>
                                    </div>
                                    <div class="flex flex-col gap-4">
                                        <button type='submit'
                                            class="flex items-center justify-center font-semibold text-base leading-normal px-6 py-4 h-14 rounded-lg bg-primary text-white hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary dark:ring-offset-background-dark transition-colors duration-200">Đăng
                                            nhập</button>
                                        <p class="text-center text-sm text-gray-600 dark:text-gray-400">
                                            Chưa có tài khoản?
                                            <a class="font-medium text-primary hover:underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary rounded-sm"
                                                href="{{ route('register') }}">Đăng ký ngay</a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="md:flex w-full md:w-1/2">
                        <div class="w-full h-full bg-center bg-no-repeat bg-cover"
                            data-alt="A clean, modern clinic interior with a friendly doctor consulting a patient."
                            style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBFt1TEAwnXQReYF7dOS71KYXlTHSUzPMRW47zei_0RMjNNO1c0uULIhGZyzzR-Scr6GJx_S9_xIwY_6rC00Qf8CqPMQMBoiLxT_ENRZB-oc8MtmRKETnLrfzJHLyz2iwylyOw8sgodml6QzUDT2FNXImA-zawAfmB3SVdLMSOy5MdY2luXe0as0AcN5sNsBDZ3ShDpgn6C7BqzCFnH3o5yjF1FPX7aw4hqwte7nrR0FuiSGBAd93u2LVofPh0Ocpfeh75RzK4St-A");'>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
