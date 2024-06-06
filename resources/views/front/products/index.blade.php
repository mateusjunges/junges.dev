<x-app-layout title="Developer pairing sessions">
    @section('no-banner', true)
    <div class="markup">
        <h1>Developer pairing sessions</h1>

        <p>If you are stuck on a problem or just want some help integrating one of my packages into your app, pairing session are just for you!</p>
    </div>

    <div class="mt-5">
        <div class="flex flex-col sm:flex-row sm:items-center sm:gap-6">
            <h1 class="text-2xl font-bold">30-minute pairing session</h1>
            <div class="underline sm:no-underline sm:bg-blue-200/50 rounded-full py-1 sm:px-2 text-sm sm:text-xs sm:text-center font-bold w-44">
                Quick and focused help
            </div>
        </div>

        <p class="mt-4">
            Perfect for developers who need quick assistance or want to focus on a specific issue. In just 30 minutes, you'll receive guidance that can help you overcome immediate challenges and improve your coding practices.
        </p>

        <ul class="mt-4 space-y-2">
            <li>
                <span class="font-bold">Duration: </span> 30 minutes
            </li>
            <li class="font-bold">
                What to expect:
            </li>
            <li class="ml-4">
                <ul class="space-y-1 list-disc">
                    <li>Targeted problem-solving</li>
                    <li>Code reviews</li>
                    <li>Quick tips and tricks</li>
                    <li>Immediate feedback on your code</li>
                </ul>
            </li>
        </ul>

        <div class="mt-5" action="" method="post">
            <a href="{{ route('product.show', $thirtyMinutesSession) }}"
                class="py-2 px-3 mx-auto button bg-blue-darker border-b-gray-900 hover:underline rounded mb-8 text-white">
                Book now for {{ $thirtyMinutesSession->getFormattedPrice() }}
            </a>
        </div>
    </div>

    <div class="mt-10">
        <div class="flex flex-col sm:flex-row sm:items-center">
            <h1 class="text-2xl font-bold">1 hour pairing session</h1>
            <div class="sm:ml-6 underline sm:no-underline sm:bg-blue-200/50 rounded-full py-1 sm:px-2 text-sm sm:text-xs sm:text-center font-bold w-44">
                In-depth exploration
            </div>
        </div>

        <p class="mt-4">
            Ideal for developers looking to dive deeper into complex problems, learn new skills, or explore best practices in a more comprehensive manner. This extended session allows for thorough discussions and hands-on coding.
        </p>

        <ul class="mt-4 space-y-2">
            <li>
                <span class="font-bold">Duration: </span> 1 hour
            </li>
            <li class="font-bold">
                What to expect:
            </li>
            <li class="ml-4">
                <ul class="space-y-1 list-disc">
                    <li>Detailed problem-solving</li>
                    <li>In-depth code reviews</li>
                    <li>Learning new techniques and methodologies</li>
                    <li>Extensive feedback and discussion</li>
                </ul>
            </li>
        </ul>

        <div class="mt-5" action="" method="post">
            <a href="{{ route('product.show', $oneHourSession) }}"
               class="py-2 px-3 mx-auto button bg-blue-darker border-b-gray-900 hover:underline rounded mb-8 text-white">
                Book now for {{ $oneHourSession->getFormattedPrice() }}
            </a>
        </div>
    </div>
</x-app-layout>
