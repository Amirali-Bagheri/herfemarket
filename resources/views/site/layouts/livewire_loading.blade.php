<div wire:loading.class.remove="hidden" {!!  isset($target) ? 'wire:target="'.$target.'"' : '' !!}
    class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-200 opacity-75 flex flex-col items-center justify-center d-none"
    wire:loading.class.remove="d-none"
    style="position: absolute; left: 50%; top: 50%; transform: translateX(-50%);">
    <svg width="20" viewBox="0 0 135 140" xmlns="http://www.w3.org/2000/svg"
         fill="rgb(45, 55, 72)"
         class="w-8 h-8">
        <rect y="10" width="15" height="120" rx="6">
            <animate attributeName="height" begin="0.5s" dur="1s"
                     values="120;110;100;90;80;70;60;50;40;140;120"
                     calcMode="linear" repeatCount="indefinite"></animate>
            <animate attributeName="y" begin="0.5s" dur="1s"
                     values="10;15;20;25;30;35;40;45;50;0;10"
                     calcMode="linear"
                     repeatCount="indefinite"></animate>
        </rect>
        <rect x="30" y="10" width="15" height="120" rx="6">
            <animate attributeName="height" begin="0.25s" dur="1s"
                     values="120;110;100;90;80;70;60;50;40;140;120"
                     calcMode="linear" repeatCount="indefinite"></animate>
            <animate attributeName="y" begin="0.25s" dur="1s"
                     values="10;15;20;25;30;35;40;45;50;0;10"
                     calcMode="linear"
                     repeatCount="indefinite"></animate>
        </rect>
        <rect x="60" width="15" height="140" rx="6">
            <animate attributeName="height" begin="0s" dur="1s"
                     values="120;110;100;90;80;70;60;50;40;140;120"
                     calcMode="linear" repeatCount="indefinite"></animate>
            <animate attributeName="y" begin="0s" dur="1s"
                     values="10;15;20;25;30;35;40;45;50;0;10"
                     calcMode="linear"
                     repeatCount="indefinite"></animate>
        </rect>
        <rect x="90" y="10" width="15" height="120" rx="6">
            <animate attributeName="height" begin="0.25s" dur="1s"
                     values="120;110;100;90;80;70;60;50;40;140;120"
                     calcMode="linear" repeatCount="indefinite"></animate>
            <animate attributeName="y" begin="0.25s" dur="1s"
                     values="10;15;20;25;30;35;40;45;50;0;10"
                     calcMode="linear"
                     repeatCount="indefinite"></animate>
        </rect>
        <rect x="120" y="10" width="15" height="120" rx="6">
            <animate attributeName="height" begin="0.5s" dur="1s"
                     values="120;110;100;90;80;70;60;50;40;140;120"
                     calcMode="linear" repeatCount="indefinite"></animate>
            <animate attributeName="y" begin="0.5s" dur="1s"
                     values="10;15;20;25;30;35;40;45;50;0;10"
                     calcMode="linear"
                     repeatCount="indefinite"></animate>
        </rect>
    </svg>
</div>
