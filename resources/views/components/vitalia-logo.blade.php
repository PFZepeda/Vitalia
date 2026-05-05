<div {{ $attributes->merge(['class' => 'flex flex-col items-center gap-6']) }}>
    <div class="flex h-[168px] w-[168px] items-center justify-center rounded-2xl bg-[#eef3f8]">
        @php
            $logo = file_get_contents(resource_path('assets/VitaliaLogo.svg'));
            $logo = str_replace('<svg ', '<svg class="h-[102px] w-[86px]" ', $logo);
            echo $logo;
        @endphp
    </div>
</div>
