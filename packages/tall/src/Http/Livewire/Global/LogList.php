<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Http\Livewire\Global;

use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use Opcodes\LogViewer\Exceptions\InvalidRegularExpression;
use Opcodes\LogViewer\Facades\LogViewer;
use Opcodes\LogViewer\Level;
use Opcodes\LogViewer\LogReader;
use Opcodes\LogViewer\PreferenceStore;

class LogList extends Component
{
  
    public ?string $selectedFileIdentifier = 'laravel.log';

    public ?int $log = null;


    public function mount()
    {
        $preferenceStore = app(PreferenceStore::class);

        $file = LogViewer::getFile($this->selectedFileIdentifier);

        $this->selectedFileIdentifier = $file?->identifier;
    }

    public function render()
    {
        $file = LogViewer::getFile($this->selectedFileIdentifier);
        $selectedLevels = $this->getSelectedLevels();
        $logQuery = $file?->logs()->only($selectedLevels);

        $levels = $logQuery?->getLevelCounts();
        $logs = $logQuery?->paginate(15);

        return view('tall::livewire.global.log-list', [
            'file' => $file,
            'levels' => $levels,
            'logs' => $logs,
        ]);
    }

    public function updatingQuery()
    {
        $this->resetPage();
        $this->queryError = '';
    }

    public function clearQuery()
    {
        $this->query = '';
        $this->queryError = '';
    }

    public function selectFile(?string $fileIdentifier)
    {
        if (isset($this->selectedFileIdentifier)) {
            $this->resetPage();
        }

        $this->selectedFileIdentifier = $fileIdentifier;
    }

    public function toggleLevel(string $level)
    {
        $this->resetPage();
        $selectedLevels = $this->getSelectedLevels();

        if (in_array($level, $selectedLevels)) {
            $selectedLevels = array_diff($selectedLevels, [$level]);
        } else {
            $selectedLevels[] = $level;
        }

        $this->saveSelectedLevels($selectedLevels);
    }

    public function selectAllLevels()
    {
        $this->saveSelectedLevels(Level::caseValues());
    }

    public function deselectAllLevels()
    {
        $this->saveSelectedLevels([]);
    }

    public function reloadResults()
    {
        //
    }

    public function clearCacheAll()
    {
        LogViewer::getFiles()->each->clearCache();

        $this->cacheRecentlyCleared = true;

        $this->dispatchBrowserEvent('scan-files');
    }

    public function updatedPerPage($value)
    {
        app(PreferenceStore::class)->put('per_page', $value);
    }

    public function updatedDirection($value)
    {
        app(PreferenceStore::class)->put('log_sort_direction', $value);
    }

    public function toggleShorterStackTraces()
    {
        $this->shorterStackTraces = ! $this->shorterStackTraces;
        app(PreferenceStore::class)->put('shorter_stack_traces', $this->shorterStackTraces);
    }

    public function toggleAutomaticRefresh()
    {
        $this->refreshAutomatically = ! $this->refreshAutomatically;
        app(PreferenceStore::class)->put('refresh_automatically', $this->refreshAutomatically);
    }

    public function getSelectedLevels(): array
    {
        $levels = app(PreferenceStore::class)->get('selected_levels');

        if (is_null($levels)) {
            $levels = LogReader::getDefaultLevels();
        }

        return $levels;
    }

    public function saveSelectedLevels(array $levels): void
    {
        app(PreferenceStore::class)->put('selected_levels', $levels);
    }

    protected function getRequestPerformanceInfo(): array
    {
        $startTime = defined('LARAVEL_START') ? LARAVEL_START : request()->server('REQUEST_TIME_FLOAT');
        $memoryUsage = number_format(memory_get_peak_usage(true) / 1024 / 1024, 2).' MB';
        $requestTime = number_format((microtime(true) - $startTime) * 1000, 0).'ms';

        return [
            'memoryUsage' => $memoryUsage,
            'requestTime' => $requestTime,
            'version' => LogViewer::version(),
        ];
    }
}
