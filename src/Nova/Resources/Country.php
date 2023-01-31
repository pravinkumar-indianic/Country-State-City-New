<?php

namespace Indianic\CountryStateCityManagement\Nova\Resources;

use App\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\HasMany;
use Trin4ik\NovaSwitcher\NovaSwitcher;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Http\Requests\NovaRequest;

class Country extends Resource {

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Indianic\CountryStateCityManagement\Models\Country::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'shortname', 'name', 'phonecode'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request) {
        return [
            ID::make()->sortable(),
            
            Text::make('Contry Code', 'shortname')
                    ->sortable()
                    ->rules('required', 'max:2'),
            
            Image::make('Country Flag', 'flag_image')
                    ->path('flags')
                    ->preview(function ($value, $disk) {
                        return $value ? Storage::disk($disk)->url($value) : null;
                    })
                    ->help('Upload an image to display the country flag')
                    ->maxWidth(100)
                    ->prunable()
                    ->deletable(false),
            
            Text::make('name')
                    ->sortable()
                    ->rules('required', 'max:255'),
            
            Text::make('phonecode')
                    ->sortable()
                    ->rules('required', 'max:5'),
            HasMany::make('State', 'state', \Indianic\CountryStateCityManagement\Nova\Resources\State::class),
            
            NovaSwitcher::make('Status')
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request) {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request) {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request) {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request) {
        return [];
    }

}
