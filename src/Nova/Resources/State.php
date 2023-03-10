<?php

namespace Indianic\CountryStateCityManagement\Nova\Resources;

use Illuminate\Http\Request;
use App\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsTo;
use Trin4ik\NovaSwitcher\NovaSwitcher;
use Laravel\Nova\Http\Requests\NovaRequest;

class State extends Resource {

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Indianic\CountryStateCityManagement\Models\State::class;

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
        'id', 'name', 'country_id'
    ];

    /**
     * To remove the link from main menu
     *
     */
    public static $displayInNavigation = false;

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request) {
        return [
            ID::make()->sortable(),
            
            Text::make('name')
                    ->sortable()
                    ->rules('required', 'max:255'),
            
            HasMany::make('City', 'city', \Indianic\CountryStateCityManagement\Nova\Resources\City::class),
            
            BelongsTo::make('Country', 'country', \Indianic\CountryStateCityManagement\Nova\Resources\Country::class),
            
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
