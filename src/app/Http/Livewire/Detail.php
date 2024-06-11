<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Detail extends Component
{

    public $showDetail = false;
    public $contact;
    public $category;

    public function mount($contact, $category)
    {
        $this->contact = $contact;
        $this->category = $category;
    }

    public function render()
    {
        return view('livewire.detail');
    }

    public function openDetail()
    {
        $this->showDetail = true;
    }

    public function closeDetail()
    {
        $this->showDetail = false;
    }

    // public function delete()
    // {
    //     // ここに削除ロジックを追加
    //     $this->contact->delete();

    //     $this->emit('postDeleted');
    //     // モーダルを閉じる
    //     $this->closeModal();
    // }
}
