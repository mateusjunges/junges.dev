@if(isset($seo))
    {{ $seo }}
@else

    <meta name="description" content="Mateus Junges is a developer at Interaction Design Foundation.">

    <meta property="og:site_name" content="junges.dev">
    <meta property="og:locale" content="en_US">
    <meta property="og:description" content="Mateus JUnges is a Laravel developer at Interaction Design Foundation.">
    <meta property="og:url" content="{{ request()->fullUrl() }}">
    <script type='application/ld+json'>
    {
        "@context":"http:\/\/schema.org",
        "@type":"WebSite",
        "@id":"#website",
        "url":"https:\/\/junges.dev\/",
        "name":"junges.dev",
        "alternateName":"A blog on PHP and Laravel"
    }

    </script>
    <script type='application/ld+json'>
    {
        "@context":"http:\/\/schema.org",
        "@type":"Person",
        "sameAs":["https:\/\/twitter.com\/mateusjungess"],
        "@id":"#person",
        "name":"Mateus junges"
    }

    </script>
@endif
