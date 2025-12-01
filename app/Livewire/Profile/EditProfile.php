<?php

namespace App\Livewire\Profile;

use App\Models\Profile;
use App\Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;


#[Title('Edit-Profile')]
class EditProfile extends Component
{
    use WithFileUploads;

    public $profile;    // <-- Needed
    public $name;
    public $email;
    public $bio;
    public $newAvatar;

    public $old_password;
    public $new_password;
    public $confirm_password;

    public $showPasswordSection = false;

    public function mount()
    {
        $user = Auth::user();

        $this->profile = Profile::where('user_id', $user->id)->first(); // <-- MUST HAVE

        $this->name  = $user->name;
        $this->email = $user->email;
        $this->bio   = $this->profile?->bio;
    }

    public function updateProfile()
    {
        $this->validate([
            'name'  => 'required|string|max:50',
            'email' => 'required|email',
            'bio'   => 'nullable|string|max:255',
            'newAvatar' => 'nullable|image|max:2048',
        ]);

        $user = Auth::user();

        $user->update([
            'name'  => $this->name,
            'email' => $this->email,
        ]);

        // Update or create profile
        $profile = Profile::updateOrCreate(
            ['user_id' => $user->id],
            ['bio' => $this->bio]
        );

        // Avatar update
        if ($this->newAvatar) {

            if ($profile->avatar && file_exists(storage_path("app/public/" . $profile->avatar))) {
                unlink(storage_path("app/public/" . $profile->avatar));
            }

            $path = $this->newAvatar->store('avatars', 'public');

            $profile->update([
                'avatar' => $path
            ]);
        }

        $this->profile = $profile; // <-- IMPORTANT (refresh)

        session()->flash('success', 'Profile updated successfully!');
        return redirect('/profile');
    }

    public function togglePasswordSection()
    {
        $this->showPasswordSection = !$this->showPasswordSection;
    }

    public function updatePassword()
    {
        $this->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user = Auth::user();

        if (!Hash::check($this->old_password, $user->password)) {
            session()->flash('error', 'Old password is incorrect.');
            return;
        }

        $user->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->old_password = $this->new_password = $this->confirm_password = "";

        session()->flash('success', 'Password updated successfully!');

        return redirect('/profile');
    }


    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.profile.edit-profile');
    }
}
