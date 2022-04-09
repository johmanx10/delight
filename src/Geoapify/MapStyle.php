<?php

declare(strict_types=1);

namespace Delight\Website\Geoapify;

enum MapStyle: string
{
    case CARTOGRAPHIC = 'osm-carto';
    case BRIGHT = 'osm-bright';
    case BRIGHT_GREY = 'osm-bright-grey';
    case BRIGHT_SMOOTH = 'osm-bright-smooth';
    case KLOKANTECH = 'klokantech-basic';
    case LIBERTY = 'osm-liberty';
    case MAP_TILER_3D = 'maptiler-3d';
    case TONER = 'toner';
    case TONER_GREY = 'toner-grey';
    case POSITRON = 'positron';
    case POSITRON_BLUE = 'positron-blue';
    case POSITRON_RED = 'positron-red';
    case DARK_MATTER = 'dark-matter';
    case DARK_MATTER_BROWN = 'dark-matter-brown';
    case DARK_MATTER_GREY = 'dark-matter-grey';
    case DARK_MATTER_PURPLE = 'dark-matter-purple';
    case DARK_MATTER_PURPLE_ROADS = 'dark-matter-purple-roads';
    case DARK_MATTER_YELLOW_ROADS = 'dark-matter-yellow-roads';
}
