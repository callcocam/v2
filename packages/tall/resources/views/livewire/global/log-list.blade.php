<table wire:key="{{ \Illuminate\Support\Str::random(16) }}" class="border-separate flex flex-col">
    <thead class="bg-gray-50">
        <tr>
            <th>
                <span class="text-black">Level icon</span>
            </th>
        </tr>
    </thead>

    <tbody>
        @foreach ($logs as $index => $log)
            <tr class=" text-black flex flex-col">
                <td class="block">
                    @if ($log->level->getClass() === 'danger')
                        <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <use href="#icon-danger" />
                        </svg>
                    @elseif($log->level->getClass() === 'warning')
                        <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <use href="#icon-warning" />
                        </svg>
                    @else
                        <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <use href="#icon-info" />
                        </svg>
                    @endif
                    {{ $log->level->getName() }}
                    {!! $log->time->toDateTimeString() !!}
                    {!! $log->environment !!}
                    {!! $log->text !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
