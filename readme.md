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
* <del>in `js/ravel.js`, `if ( jQuery( 'body' ).has( '.tabs-nav' ) ) {` seems to be irrelevant. If you change it to `.has( '.safdsafdsfas' )`, the code within the conditional still executes, but shouldn't.</del>
	* <ins>The check isn't really needed.</ins>

## TODO's:

* Logo customizer setting
* <del>Search widget not working. Seems to be a Hybrid Core problem. Ravel is using</del> 
* <del>Filter `get_search_form()` output based on `searchform.php`</del>
* Finish up tabs widget
* Full RTL support? This is up to you. I'm a bit lazy to test for RTL. In `style.css`, there are some RTL CSS carried over from my previous themes.
	* <ins>This can actually be quite involved and is best done from the ground up as the theme is being built. You'd do a better job with this since you wrote the CSS. For v.1.0, I say to wait on this.</ins>
* Language .pot file.
* Double check all files
* Run theme check plugin
* Demo site (I'll take care of this if you give me access to it)
* Theme screenshot -- this is based on the demo site so will add this after demo is set up.

### Tabs Widget:

* <del>This widget is used to display up to 4 groups of content: Recent Posts, Popular Posts, Comments, and Tags. You can also use it to display just `Recent Comments` or just `Popular Posts` -- I really like this part from the original widget.</del>
	* <ins>I decided to allow the user to set the number of posts, comments, or tags to "0".  In that case, the tab doesn't show.  It's not as intuitive, but it does cut out 4 options.</ins>
* When more than one group of content are on display, the widget title is automatically hidden in favor of the tabs nav. Right now, the widget displays the title unless the title is empty.
	* <ins>This is standard behavior for widgets.  If the user inputs a title, a title is expected.  If left empty, the title should not show.  Doing otherwise also can also mess with plugins that filter some of the widget-related hooks.</ins>
	* <ins>Decided on not setting a default title for the widget. This way, the user must enter a title if they want it to show.</ins>
* <del>Can you bring back the category link for the Recent Posts and Popular Posts entries or replace it with a post format archive link?</del>
	* <ins>Used the post format link. That's easier to control since users won't be putting 100 of those in and saves some dev work getting the first cat.</ins>
* <del>For Recent Posts, Popular Posts, and Recent Comments, allow users to select number of entries to display.</del>
	* <ins>Can set the number of tags now too for consistency.</ins>
* Allow users to set the order of tabs.
	* <ins>This is ripe with problems (within my current skillset).  The only good way to do this is to allow the user to move this around with jQuery.  I haven't learned how to do this yet.</ins>

Additional notes on tabs:  In general, we should keep the settings to a minimum.  If the theme is popular enough, users are going to want more options, more options, and more options (I've seen this with tab plugins before, which is why I built Whistles).  This is a bit of a slippery slope, so I want to just draw a line in the sand and say, "These are the options that are available, but if you want more control, check out this plugin over here."  But, it also allows us room to grow based on feedback if we want to add more stuff later.

I'm going to play my developer card here and say that this is what I can do for v.1.0.