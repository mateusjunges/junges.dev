<li class="{{ implode(' ', array_merge(['flex', 'items-center'], $classes ?? []))}}">
    <img
        src="{{ $avatarUrl ?? asset('images/avatar.png')}}"
        alt="avatar" class="object-cover w-10 h-10 mx-4 rounded-full">
    <p>
        <a href="#" class="mx-1 font-bold text-gray-700 hover:underline">{{ $name ?? 'John Doe' }}</a>
        <span class="text-sm font-light text-gray-700">Created {{ $postsCount ?? 1 }} Posts</span>
    </p>
</li>
