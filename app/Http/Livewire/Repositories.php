<?php

namespace App\Http\Livewire;

use App\Models\Repository;
use Illuminate\Support\Collection;
use Livewire\Component;

class Repositories extends Component
{
    public string $search = '';

    public string $sort = '-downloads';

    public string $type = 'packages';

    public bool $filterable = true;

    public bool $highlighted = false;

    protected $queryString = ['search', 'sort'];

    public function mount(
        $type = 'packages',
        $filterable = true,
        $highlighted = false,
        $sort = '-downloads'
    ): void {
        $this->type = $type;
        $this->filterable = $filterable;
        $this->highlighted = $highlighted;
        $this->sort = request()->query('sort', $sort);
        $this->search = empty(request()->query('search', '')) ? "" : request()->query('search', '');
    }

    private function getRepositories(): Collection
    {
        $query = Repository::visible();

        $this->type === 'projects'
            ? $query->projects()
            : $query->packages();

        if ($this->highlighted) {
            $query->highlighted();
        }

        $query
            ->search($this->search)
            ->applySort($this->sort);

        return $query->get();
    }

    public function render()
    {
        return view('livewire.repositories', [
            'repositories' => $this->getRepositories(),
        ]);
    }
}
