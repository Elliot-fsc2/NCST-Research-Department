<?php

namespace App\Livewire;

use App\Models\Announcement;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Rule;
use Mary\Traits\Toast;

#[Title('Announcements')]
class HeadAnnouncement extends Component
{
    use WithPagination, Toast;

    #[Rule('required|min:5|max:100')]
    public $title = '';

    #[Rule('required|min:10')]
    public $content = '';

    public $editingId = null;
    public $isModalOpen = false;

    public function createAnnouncement()
    {
        $this->validate();

        Announcement::create([
            'title' => $this->title,
            'content' => $this->content,
            'user_id' => auth()->id()
        ]);

        $this->reset(['title', 'content', 'isModalOpen']);
        $this->success( 'Announcement created successfully!');
    }

    public function editAnnouncement($id)
    {
        $announcement = Announcement::find($id);
        $this->editingId = $id;
        $this->title = $announcement->title;
        $this->content = $announcement->content;
        $this->isModalOpen = true;
    }

    public function updateAnnouncement()
    {
        $this->validate();

        Announcement::find($this->editingId)->update([
            'title' => $this->title,
            'content' => $this->content
        ]);

        $this->reset(['title', 'content', 'editingId', 'isModalOpen']);
        $this->success('Announcement updated successfully!');
    }

    public function deleteAnnouncement($id)
    {
        Announcement::find($id)->delete();
        $this->dispatch('toast', 'Announcement deleted successfully!');
    }

    public function render()
    {
        return view('livewire.head-announcement', [
            'announcements' => Announcement::latest()->paginate(10)
        ]);
    }
}
