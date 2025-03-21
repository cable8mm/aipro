<x-inspection-layout>
    <div class="container max-w-screen-lg mx-auto">
        <div class="grid grid-cols-3 gap-2">
            @foreach ($barcodeCommands as $barcodeCommand)
                <div class="text-center">
                    <div class="text-2xl font-bold p-4">{{ $barcodeCommand->name }}</div>
                    <div>
                        <img class="mx-auto"
                            src="{{ route('generate-barcode', ['barcode' => $barcodeCommand->barcode]) }}">
                    </div>
                </div>
            @endforeach
            @foreach ($boxes as $box)
                <div class="text-center">
                    <div class="text-2xl font-bold p-4">{{ $box->name }}</div>
                    <div>
                        <img class="mx-auto"
                            src="{{ route('generate-barcode', ['barcode' => \App\Support\Gtin::ofBox($box->id)]) }}">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-inspection-layout>
