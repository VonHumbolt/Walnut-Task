<x-layout>
    
    <h1>Callback Logs</h1>

    <div>
        @foreach ($logs as $log)
            <p> {{ $log->result }} </p>
        @endforeach
    </div>
</x-layout>
