<?php

namespace App\Filament\Resources;

use App\Models\Post;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Conteúdo';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->label('Título')
                ->required()
                ->maxLength(255)
                ->reactive()
                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

            Forms\Components\TextInput::make('slug')
                ->label('Slug')
                ->required()
                ->unique(ignoreRecord: true)
                ->helperText('Usado na URL do post (ex: meu-primeiro-post)'),

            Forms\Components\RichEditor::make('content')
                ->label('Conteúdo')
                ->required(),

            Forms\Components\FileUpload::make('image')
                ->label('Imagem principal')
                ->image()
                ->directory('posts/images') // pasta onde vai armazenar
                ->maxSize(2048) // tamanho máximo em KB
                ->imagePreviewHeight('250') // preview no painel
                ->required(false),

            Forms\Components\Select::make('status')
                ->label('Status')
                ->options([
                    'draft' => 'Rascunho',
                    'published' => 'Publicado',
                ])
                ->default('draft'),

            Forms\Components\Select::make('user_id')
                ->label('Autor')
                ->relationship('user', 'name')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('image')
                ->label('Imagem')
                ->circular(), // ou ->square()

            Tables\Columns\TextColumn::make('title')
                ->label('Título')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('user.name')
                ->label('Autor'),

            Tables\Columns\TextColumn::make('status')
                ->label('Estado')
                ->badge(),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Criado em')
                ->dateTime(),
        ]);
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        // ✅ Vincular automaticamente ao utilizador autenticado se quiseres
        $data['user_id'] = Auth::id();
        return $data;
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => PostResource\Pages\ListPosts::route('/'),
            'create' => PostResource\Pages\CreatePost::route('/create'),
            'edit' => PostResource\Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
