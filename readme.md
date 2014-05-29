# Ravel WordPress Theme

A work in progress...

### Changes:

* FontAwesome updated to v.4.1.0
* Bunch of CSS changes
* PHP/HTML in all `content/` files
* CSS classes in wiget-ravel-tabs.php. Also, widget class changed to `widget_util_tabs`
* Theme Layout `customize` and `post_meta` are set to false. This is because the theme is not designed for one column. It just look awkward.
* The way Singular Portfolio Items grab attached images
* `taxonomy-portfolio.php` now uses `archive-portfolio_item.php`
* Added editor style CSS
* Added `searchform.php`
* Added `menu/portfolio.php`
* `sidebar/primary.php now` checks for `if ( $layout !== 'layout-1c' )` instead of `get_theme_mod`

### Notes:
* in `js/ravel.js`, `if ( jQuery( 'body' ).has( '.tabs-nav' ) ) {` seems to be irrelevant. If you change it to `.has( '.safdsafdsfas' )`, the code within the conditional still executes, but shouldn't.

## TODO's:

* Logo customizer setting
* Search widget not working. Seems to be a Hybrid Core problem. Ravel is using 
* Filter `get_search_form()` output based on `searchform.php`
* Finish up tabs widget
* Full RTL support? This is up to you. I'm a bit lazy to test for RTL. In `style.css`, there are some RTL CSS carried over from my previous themes.
* Language .pot file.
* Double check all files
* Run theme check plugin
* Demo site (I'll take care of this if you give me access to it)
* Theme screenshot -- this is based on the demo site so will add this after demo is set up.

### Tabs Widget:
* This widget is used to display up to 4 groups of content: Recent Posts, Popular Posts, Comments, and Tags. You can also use it to display just `Recent Comments` or just `Popular Posts` -- I really like this part from the orignal widget.
* When more than one group of content are on display, the widget title is automatically hidden in favor of the tabs nav. Right now, the widget displays the title unless the title is empty.
* Can you bring back the category link for the Recent Posts and Popular Posts entries or replace it with a post format archive link?
* For Recent Posts, Popular Posts, and Recent Comments, allow users to select number of entries to display.
* Allow users to set the order of tabs.