
@extends('layouts/auth_app')

@section('content')

    <div class='grid grid-cols-12 col-gap-5 mb-5 md:mt-5 lg:mt-0'>
        @foreach($crypto as $currency)
            <div class='col-span-12 md:col-span-4 bg-white flex flex-col mb-5 p-5 shadow'>
                <p class='m-0 mb-3 symbol'>{{ $currency->symbol }}</p>
                <p class='m-0 mb-3 text-sm'>{{  strlen($currency->company) > 40 ? substr($currency->company, 0, 37) . '...' : $currency->company }}</p>
                <p class='hidden name'>{{ $currency->company }}</p>
                <p class='m-0 text-sm hidden type'>{{ $type }}</p>
                <div class='flex flex-row justify-between items-center'>
                    @php
                        $isSubscribed = in_array($currency->company, array_keys($subscriptions)) * in_array($currency->symbol, array_values($subscriptions))
                    @endphp
                    <p class='m-0 cursor-pointer text-sm action 
                    {{ $isSubscribed ? "action-unsubscribe" : "action-subscribe" }}'>
                        {{ $isSubscribed ? "unsubscribe" : "subscribe" }}
                    </p>

                    @if($isSubscribed)
                        <i class='fa fa-check-circle' style='color:#537A5A'></i>
                    @else 
                        <i class='fa' style='color:#537A5A'></i>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <div class='w-full grid grid-cols-12 col-gap-5'>
        @if($index > 1 && $index <= $maxIndex)
            <div class='col-span-3 sm:col-span-2 bmd:col-span-1 p-3'>
                <a href='{{ route("crypto", ["index" => $index - 1]) }}'><<<</a>
            </div>
        @endif

        @for($i = $paginateStart; $i < ($paginateStart + $numElements); $i++)
            @if($i <= $paginateMax)
                <div class='col-span-3 sm:col-span-2 bmd:col-span-1 flex flex-row justify-center p-3 mb-5 {{ $i === $paginateCurrent ? "bg-yeet-blue text-white" : "" }}'>
                    <a href='{{ route("crypto", ["index" => $index, "page" => ($i - $paginateStart) + 1]) }}'>{{ $i }}</a>
                </div>
            @endif
        @endfor

        @if($index < $maxIndex)
            <div class='col-span-3 sm:col-span-2 bmd:col-span-1 p-3'>
                <a href='{{ route("crypto", ["index" => $index + 1]) }}'>>>></a>
            </div>
        @endif
    </div>
@endsection