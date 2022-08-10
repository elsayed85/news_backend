<?php

namespace App\Filament\Resources\Videos;

use App\Filament\Resources\Videos\VideoResource\Pages;
use App\Filament\Resources\Videos\VideoResource\RelationManagers;
use App\Models\Videos\Video;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Forms\Components\SpatieTagsInput;
use Stephenjude\FilamentBlog\Traits\HasContentEditor;
use function now;


class VideoResource extends Resource
{
    use HasContentEditor;
    protected static ?string $model = Video::class;

    protected static ?string $modelLabel = 'Video';

    protected static ?string $slug = 'videos/videos';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationGroup = 'Videos';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                        Forms\Components\TextInput::make('slug')
                            ->disabled()
                            ->required()
                            ->unique(Video::class, 'slug', fn ($record) => $record),

                        Forms\Components\Textarea::make('excerpt')
                            ->rows(2)
                            ->minLength(50)
                            ->maxLength(1000)
                            ->columnSpan([
                                'sm' => 2,
                            ]),

                        Forms\Components\FileUpload::make('thumb')
                            ->image()
                            ->maxSize(5120)
                            ->imageCropAspectRatio('16:9')
                            ->directory('videos')
                            ->columnSpan([
                                'sm' => 2,
                            ]),

                        self::getContentEditor('content'),


                        Forms\Components\MultiSelect::make('categories')
                            ->relationship('categories', 'name')
                            ->searchable()
                            ->required(),

                        Forms\Components\DatePicker::make('published_at')
                            ->label('Published Date'),
                        SpatieTagsInput::make('tags')
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
                                ?Video $record
                            ): string => $record ? $record->created_at->diffForHumans() : '-'),
                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn (
                                ?Video $record
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
                Tables\Columns\ImageColumn::make('thumb')
                    ->rounded(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('author.name')
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
                            ->placeholder(fn ($state): string => 'Dec 18, '.now()->subYear()->format('Y')),
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
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'view' => Pages\ViewVideo::route('/{record}'),
            'edit' => Pages\EditVideo::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
