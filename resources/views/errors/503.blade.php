<x-error-layout
    :error-code="503"
    :title="'Under maintenance'"
    :error-message="'Temporarily down for maintenance, but will be back soon!'"
    :error-description-html="' Sorry for the inconvenience but I\'m performing some maintenance at the moment.
            If you need to you can always <a class=\'text-blue-800 hover:underline\' href=\'mailto:mateus@junges.dev\'>Contact me </a>, otherwise
this site will be back online shortly!'">
</x-error-layout>
