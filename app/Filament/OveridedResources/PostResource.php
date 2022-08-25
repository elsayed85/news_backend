<?php

namespace App\Filament\OveridedResources;

use App\Models\FilamentBlog\Post;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

use function now;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use MartinRo\FilamentCharcountField\Components\CharcountedTextarea;
use Stephenjude\FilamentBlog\Resources\PostResource\Pages;
use Stephenjude\FilamentBlog\Traits\HasContentEditor;

class PostResource extends Resource
{
    use HasContentEditor;

    protected static ?string $model = Post::class;

    protected static ?string $slug = 'blog/posts';

    protected static ?string $recordTitleAttribute = 'title';


    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 0;

    protected static function getNavigationGroup(): ?string
    {
        return __('blog.title');
    }

    protected static function getNavigationLabel(): string
    {
        return __('blog.posts.title');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->reactive()
                            ->label('عنوان الخبر')
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                        Forms\Components\TextInput::make('slug')
                            ->disabled()
                            ->required()
                            ->unique(Post::class, 'slug', fn ($record) => $record),

                        CharcountedTextarea::make('excerpt')
                            ->label('اختصار محتوي اخبر')
                            ->rows(4)
                            ->hintIcon('heroicon-o-code')
                            ->helperText('اختصر الخبر فى حدود 50 إلي 1000 حرف')
                            ->minCharacters(50)
                            ->maxCharacters(1000)
                            ->columnSpan([
                                'sm' => 2,
                            ]),

                        FileUpload::make('banner')
                            ->image()
                            ->maxSize(5120)
                            ->imageCropAspectRatio('16:9')
                            ->directory('blog')
                            ->columnSpan([
                                'sm' => 2,
                            ])
                            ->label('الغلاف'),

                        SpatieMediaLibraryFileUpload::make('attachments')
                            ->multiple()
                            ->maxFiles(5)
                            ->columnSpan([
                                'sm' => 2,
                            ])
                            ->label('المرفقات'),

                        self::getContentEditor('content')->label('محتوي الخبر'),

                        Forms\Components\BelongsToSelect::make('blog_author_id')
                            ->relationship('author', 'name')
                            ->searchable()
                            ->required()
                            ->label('الكاتب'),

                        Forms\Components\BelongsToSelect::make('blog_category_id')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->required()
                            ->label('القسم'),

                        SpatieTagsInput::make('tags')
                            ->required()
                            ->label('الأوسمه'),

                        Forms\Components\DatePicker::make('published_at')
                            ->label('موعد النشر'),

                        Toggle::make('is_public')
                            ->label("النشر للعامه ؟")
                            ->inline(false)
                            ->onIcon('heroicon-s-lightning-bolt')
                            ->onColor('success')
                            ->offColor('secondary'),

                        Forms\Components\MultiSelect::make('video_readers')
                            ->label("القراء")
                            ->relationship('readers', 'name')
                            ->searchable()
                            ->required(),
                    ])
                    ->columns([
                        'sm' => 2,
                    ])
                    ->columnSpan(2),
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn (
                                ?Post $record
                            ): string => $record ? $record->created_at->diffForHumans() : '-'),
                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn (
                                ?Post $record
                            ): string => $record ? $record->updated_at->diffForHumans() : '-'),
                    ])
                    ->columnSpan(1),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('banner')
                    ->rounded(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('author.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Published Date')
                    ->date(),
            ])
            ->filters([
                Tables\Filters\Filter::make('published_at')
                    ->form([
                        Forms\Components\DatePicker::make('published_from')
                            ->placeholder(fn ($state): string => 'Dec 18, ' . now()->subYear()->format('Y')),
                        Forms\Components\DatePicker::make('published_until')
                            ->placeholder(fn ($state): string => now()->format('M d, Y')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['published_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('published_at', '>=', $date),
                            )
                            ->when(
                                $data['published_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('published_at', '<=', $date),
                            );
                    }),
            ]);
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    protected static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['author', 'category']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'slug', 'author.name', 'category.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->author) {
            $details['Author'] = $record->author->name;
        }

        if ($record->category) {
            $details['Category'] = $record->category->name;
        }

        return $details;
    }
}
