@props([
    "name" => "",
    "description" => "",
    "service_id" => -1,
    "article_blocks" => [],
])



@php
    $blocks = json_decode($article_blocks->service_post)->blocks;
    $cover_image = "";
    
    foreach($blocks as $block){
        if($block->type === "image" && $cover_image === ""){
            $cover_image = $block->data->file->url;
        }
    }
@endphp

<div class="max-w-xs min-w-xs overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800 mx-2">
    <div class="px-4 py-2">
        <h1 class="text-xl font-bold text-gray-800 uppercase dark:text-white" id="title">{{ $name }}</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400" id="description">{{ $description }}</p>
    </div>

    @if($cover_image !== "")
        <img class="object-cover w-full h-48 mt-2" src="{{ $cover_image }}" alt="Service Cover" id="cover-image">
    @else
        <img class="object-cover w-full h-48 mt-2" src="{{ asset('/app_assets/article-placeholder.png') }}" alt="Service Cover" id="cover-image">
    @endif
    <div class="flex items-center justify-between px-4 py-2 bg-gray-900">
        <h1 class="text-lg font-bold text-white">Service</h1>
        <button onclick="window.location.href='{{ '/record/services/'.$service_id }}'" class="px-2 py-1 text-xs font-semibold text-gray-900 uppercase transition-colors duration-300 transform bg-white rounded hover:bg-gray-200 focus:bg-gray-400 focus:outline-none">Read Service</button>
    </div>
</div>



