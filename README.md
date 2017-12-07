# Cartographer Wordpress Plugin

Wordpress plugin for displaying map widgets containing data from [Cartographer](http://cartographer.io).

## Installation

1. Grab the latest release from the [releases page](https://github.com/cartographerio/wp-cartographer/releases), unzip it, and upload the `wp-cartographer` directory to your web server so it ends up as a subdirectory of `wp-content/plugins`:

~~~
/path/to/wordpress
 +- wp-content
     +- plugins
         +- wp-cartographer
             +- wp-cartographer.php
             +- wp-cartographer.css
             +- and so on...
~~~

2. Log in to your Wordpress admin site and navigate to the *Plugins* item in the left hand menu bar.

3. Locate *Cartographer Maps* in the list of installed plugins and click its *Activate* link.

## Usage

Once the plugin is activated you will be able to use two special [shortcodes](http://en.support.wordpress.com/shortcodes/) in your posts and pages on your Wordpress site:

 - `[cartographer_map ...options...]` inserts a map into the post or page;
 - `[cartographer_map_defaults ...options...]` specifies default options for any maps further down in the post.

The various options are described below. You must include the `subdomain` and `layer` options at minimum for your map to display correctly.

## Options

 - `subdomain` (required) -- The subdomain of your Cartographer web site. For example, if your Cartographer web address is `http://mycompany.cartographer.io` you should set this value to `mycompany`:

   ~~~
   [cartographer_map subdomain="mycompany" ...other options...]
   ~~~

 - `layer` (required) -- The map layer you wish to display, written in the format `featureType.attributeName`. Check with the Cartographer support team for a list of valid layer names for your site.

   ~~~
   [cartographer_map layer="featureType.attributeName" ...other options...]
   ~~~

 - `center` -- The initial latitude and longitude of the center of the map:

   ~~~
   [cartographer_map center="51.5,0" ...other options...]
   ~~~

 - `zoom` -- The initial zoom level from 1 to 20. 1 displays the entire world, 20 displays an extreme close-up of a particular location:

   ~~~
   [cartographer_map zoom="10" ...other options...]
   ~~~

 - `inspector` -- Whether to enable/display the inspector (left hand sidebar) and which modes to allow. Specified as a *mode* and zero or more *flags*, specified as a comma-separated list `mode,flag,flag,flag,...`:

   - `mode` is one of:
      - `no` -- don't display the inspector;
      - `yes` -- do display the inspector;
      - `data` -- do display the inspector, preselect the *Survey Data* tab;
      - `photos` -- do display the inspector, preselect the *Photos* tab;
   - each `flag` is one of:
      - `nodata` -- disable the *Survey Data* tab;
      - `nophotos` -- disable the *Photos* tab;
      - `nocharts` -- disable timelines and histograms;
      - `nolayerselect` -- prevent the user clicking the inspector to select attributes.

   ~~~
   [cartographer_map inspector="data" ...other options...]
   ~~~

 - `legend` -- Whether to enable/display the legend:

   - `no` -- completely disable the legend;
   - `hide` -- enable the legend but hide it by default;
   - `show` or `yes` -- enable the legend and show it by default.

   ~~~
   [cartographer_map legend="no" ...other options...]
   ~~~

 - `selectradius` -- The radius (in meters) used to select nearby data points for inclusion in the timeline chart in the inspector:

   ~~~
   [cartographer_map selectradius="500" ...other options...]
   ~~~

 - `from` -- Only show data collected on/after this date. Must be specified in the format `yyyy-mm-dd`:

   ~~~
   [cartographer_map from="2014-01-01" ...other options...]
   ~~~

 - `to` -- Only show data collected before this date. Must be specified in the format `yyyy-mm-dd`:

   ~~~
   [cartographer_map from="2015-01-20" ...other options...]
   ~~~

## Troubleshooting

If you encounter any problems using this plugin, please get in touch with our support team using the contact details on the [Cartographer home page](http://cartographer.io).
