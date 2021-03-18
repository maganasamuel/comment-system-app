<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script type="text/javascript" src="{{ asset('js/app.js') }}" defer>
    </script>

    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Inter' !important;
        }

    </style>
</head>

<body class="font-sans antialiased">
    <div id="app" class="h-screen flex overflow-hidden bg-white">
        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <div
                class="relative z-10 flex-shrink-0 flex h-16 bg-gray-800 border-b border-gray-200">
                <nav class="bg-gray-800">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div
                            class="relative flex items-center justify-between h-16">
                            <div
                                class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                                <div class="flex-shrink-0 flex items-center">
                                    <span
                                        class="text-white text-lg font-bold">Comment
                                        System App</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>

            <main class="flex-1 relative overflow-y-auto focus:outline-none"
                tabindex="-1">
                <div
                    class="max-w-7xl mx-auto py-8 xl:py-10 px-4 sm:px-6 lg:px-8">
                    <div>
                        <div>
                            <div
                                class="md:flex md:items-center md:justify-between md:space-x-4 xl:border-b xl:pb-6">
                                <div>
                                    <h1
                                        class="text-2xl font-bold text-gray-900">
                                        ARIA attribute misspelled</h1>
                                </div>
                            </div>
                            <div class="py-3 xl:pt-6 xl:pb-0">
                                <h2 class="sr-only">Description</h2>
                                <div class="prose max-w-none">
                                    <p>
                                        Lorem ipsum dolor sit amet
                                        consectetur adipisicing elit.
                                        Expedita, hic? Commodi cumque
                                        similique id tempora molestiae
                                        deserunt at suscipit, dolor
                                        voluptatem, numquam, harum
                                        consequatur laboriosam voluptas
                                        tempore aut voluptatum alias?
                                    </p>
                                    <ul>
                                        <li>
                                            Tempor ultrices proin nunc
                                            fames nunc ut auctor vitae
                                            sed. Eget massa parturient
                                            vulputate fermentum id
                                            facilisis nam pharetra.
                                            Aliquet leo tellus.
                                        </li>
                                        <li>
                                            Turpis ac nunc adipiscing
                                            adipiscing metus tincidunt
                                            senectus tellus.
                                        </li>
                                        <li>
                                            Semper interdum porta sit
                                            tincidunt. Dui suspendisse
                                            scelerisque amet metus eget
                                            sed. Ut tellus in sed
                                            dignissim.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <comment-section></comment-section>
                </div>
            </main>
        </div>
    </div>




</body>

</html>
