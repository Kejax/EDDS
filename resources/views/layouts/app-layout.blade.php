<!DOCTYPE html>
<html>
    <head>

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="{{ mix('js/app.js') }}" defer></script>

    </head>

    <body>

        <!-- ED Tracker Header -->
        <header class="bg-amber-600 top-0 left-0 fixed w-screen">
            <div class="mx-auto flex h-16 max-w-screen-xl item-center gap-8 px-4 sm:px-6 lg:px-8">
                <a class="block text-amber-500" href="{{ route('home') }}">
                    <span class="sr-only">Home</span>
                    <svg class="h-8" viewBox="0 0 200 200" fill="currentColor" xmlns="https://ww.w3.org/2000/svg">
                        <polygon points="117.56 81.29 117.56 95.39 105.07 95.39 105.07 127.53 140.19 87.53 146.43 50.37 117.56 81.29"/>

                        <!-- TODO: Insert rest of the svg code -->
                    </svg>
                </a>

                <div class="flex flex-1 items-center justify-end md:justify-between">
                    <nav aria-label="Global" class="hidden md:block">
                        <ul class="flex items-center gap-6 text-sm">

                            <!-- Stations -->
                            <li>
                                <a class="text-white transition hover:text-gray-500/75" href="{{ route('stations.index') }}">
                                    {{ __('Stations') }}
                                </a>
                            </li>

                            <!-- Systems -->
                            <li>
                                <a class="text-white transition hover:text-gray-500/75" href="{{ route('systems.index') }}">
                                    {{ __('Systems') }}
                                </a>
                            </li>

                            <!-- Ships -->
                            <li>
                                <a class="text-white transition hover:text-gray-500/75" href="{{ route('ships.index') }}">
                                    {{ __('Ships') }}
                                </a>
                            </li>

                            <!-- Market -->
                            <li>
                                <a class="text-white transition hover:text-gray-500/75" href="{{ route('market.index') }}">
                                    {{ __('Market') }}
                                </a>
                            </li>

                            <!-- Squadrone -->
                            <li>
                                <a class="text-white transition hover:text-gray-500/75" href="{{ route('squadrones.index') }}">
                                    {{ __('Squadrone') }}
                                </a>
                            </li>

                            <!-- History -->
                            <!--<li>
                                <a class="text-white transition hover:text-gray-500/75" href="{{ route('history.index') }}">
                                    {{ __('History') }}
                                </a>
                            </li>-->

                        </ul>
                    </nav>

                    <div class="flex items-center gap-4">
                        <div class="sm:flex sm:gap-4">
                            <a
                            class="block rounded-md bg-amber-500 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-amber-700"
                            >
                                {{ __('Sign in') }}
                            </a>
                        </div>

                        <button class="block rounded bg-gray-100 p-2.5 text-gray-600 transition hover:text-gray-600/75 md:hidden">
                            <span class="sr-only">Toggle Menu</span>
                            <!-- TODO: Insert SVG -->
                        </button>
                    </div>
                </div>
            </div>
        </header>

    </body>
</html>
