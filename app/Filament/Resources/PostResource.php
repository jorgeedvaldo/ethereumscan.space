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
    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->label('Title')
                ->required()
                ->maxLength(255)
                ->reactive()
                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

            Forms\Components\TextInput::make('slug')
                ->label('Slug')
                ->required()
                ->unique(ignoreRecord: true)
                ->helperText('Used in post URL (eg: my-first-post)'),

            Forms\Components\RichEditor::make('content')
                ->label('Content')
                ->required(),

            Forms\Components\FileUpload::make('image')
                ->label('Principal Image') // or
                ->image()
                ->directory('posts/images') // folder to store
                ->maxSize(2048) // in KB
                ->imagePreviewHeight('250')
                ->required(false),

            Forms\Components\Select::make('status')
                ->label('Status')
                ->options([
                    'draft' => 'Draft',
                    'published' => 'Published',
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
                ->label('Image')
                ->circular(), // ->square()

            Tables\Columns\TextColumn::make('title')
                ->label('Title')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('user.name')
                ->label('Author'),

            Tables\Columns\TextColumn::make('status')
                ->label('Status')
                ->badge(),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Created At')
                ->dateTime(),
        ]);
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
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
