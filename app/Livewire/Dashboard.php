<?php

namespace App\Livewire;

use App\Models\Url;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Dashboard extends Component
{
    #[Validate('required|min:3')]
    public $long_link;


    #[Validate('required|min:3|unique:urls')]
    public $back_half;


    public function submit()
    {
        $this->validate();

        Url::create([
            'user_id' => Auth::user()->id,
            'back_half' => $this->back_half,
            'long_link' => $this->long_link
        ]);

        $this->dispatch('alert', icon: 'success', title: 'Url shortened');
        $this->reset();
    }

    public function delete_link($back_half)
    {
        $url = Url::where('user_id', Auth::user()->id)->where('back_half', $back_half)->first();

        if ($url) {
            $url->delete();
            $this->dispatch('alert', icon: 'success', title: 'Url Deleted');
        } else {
            $this->dispatch('alert', icon: 'error', title: 'Url not found');
        }
    }

    public function render()
    {

        $urls = Url::where('user_id', Auth::user()->id)->groupBy('id', 'DESC')->get();

        return view('dashboard.index', compact('urls'));
    }
}
