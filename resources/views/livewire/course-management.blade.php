<div>
    <div class="mb-4">
        <x-button 
            icon="o-arrow-left" 
            label="Return to Departments" 
            link="/head/department-course-management"
            class="btn-ghost"
        />
    </div>

    <x-card title="All Programs Available in {{$department->name}}">
        <x-table :headers="$headers" :rows="$courses" show-empty-text with-pagination>
            @scope('cell_id', $role)
            {{$loop->iteration}}
            @endscope
        </x-table>
    </x-card>
</div>