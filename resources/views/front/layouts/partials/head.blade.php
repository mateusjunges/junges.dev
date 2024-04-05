<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="mobile-web-app-capable" content="yes">
<link href="https://github.com/mateusjunges" rel="me">
@isset($title)
<title>{{ $title }} - Blog and Open source docsl</title>
@else
<title>Mateus Junges's blog on PHP and Laravel</title>
@endisset
@isset($canonical)
<link rel="canonical" href="{{ $canonical }}" />
@endisset
@include('front.layouts.partials.seo')

@vite(['resources/js/app.js'])
@livewireStyles
@stack('styles')

<link rel="stylesheet" href="https://cloud.typography.com/6194432/6581412/css/fonts.css"/>
<link href="https://twitter.com/mateusjungess" rel="me">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>

<x-comments::styles />
</head>
