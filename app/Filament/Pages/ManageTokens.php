<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class ManageTokens extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-key';
    protected static string $view = 'filament.pages.manage-tokens';
    protected static ?string $title = 'Manage API Tokens';
    protected static ?string $navigationGroup = 'Settings';

    public $tokens;

    public function mount(): void
    {
        $this->tokens = Auth::user()->tokens;
    }

    public function generateToken(): void
    {
        $token = Auth::user()->createToken('API Token - ' . now()->format('Y-m-d H:i'));

        $this->tokens = Auth::user()->tokens;

        session()->flash('token', $token->plainTextToken);
        session()->flash('message', 'New token generated successfully.');
    }

    public function deleteToken($id): void
    {
        Auth::user()->tokens()->where('id', $id)->delete();
        $this->tokens = Auth::user()->tokens;

        session()->flash('message', 'Token deleted successfully.');
    }
}
