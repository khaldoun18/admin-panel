<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use App\Models\Employee;
use Filament\Actions;

use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTabs():array{
        return [
            'All'=>Tab::make()
            ->badge(Employee::count()),
            'This Week'=>Tab::make()
            ->modifyQueryUsing(fn(Builder $query)=> $query->where('date_hired', '>=', now()->startOfWeek())
            ->where('date_hired', '<=', now()->endOfWeek()))
            ->badge(Employee::query()->where('date_hired', '>=', now()->startOfWeek())
            ->where('date_hired', '<=', now()->endOfWeek())->count()),
            'This Month'=>Tab::make()
            ->modifyQueryUsing(fn(Builder $query)=> $query->where('date_hired', '>=', now()->startOfMonth())
            ->where('date_hired', '<=', now()->endOfMonth()))
            ->badge(Employee::query()->where('date_hired', '>=', now()->startOfMonth())
            ->where('date_hired', '<=', now()->endOfMonth())->count()),
            'This Year'=>Tab::make()
            ->modifyQueryUsing(fn(Builder $query)=> $query->where('date_hired', '>=', now()->startOfYear())
            ->where('date_hired', '<=', now()->endOfYear()))
            ->badge(Employee::query()->where('date_hired', '>=', now()->startOfYear())
            ->where('date_hired', '<=', now()->endOfYear())->count()),

        ];
    }
}
