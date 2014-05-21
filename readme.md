# Ravel WordPress Theme

A work in progress...

## Notes

* `post-thumbnail` size (default for galleries)?
* WordPress.org requires themes to display the site description somewhere.
* Chat post format should support more than two speakers in the CSS.
* Post byline needs to break on mobile devices.
* Footer content not aligned correctly when the Social menu is not set.
* Unstyled HTML elements:
	* `<acronym>`
	* `<abbr>`
	* `<kbd>`
	* `<tt>`
	* `<var>`
* Provide HTML for form elements in post content area.  `<fieldset>` should be looked at in particular.
* Search form on Error template should be styled for the output of the `get_search_form()` function.  The use of this function is required.  See `.screen-reader-text` class.
* Add `.screen-reader-text` class to `style.css` for general hiding of screen reader text.
* Styles need adjusting when WP admin bar is showing, particularly the sidebar toggle.
* Comment text is really hard to read for me. Consider a larger font size.
* No comment edit link.  This is pretty standard and should probably be added.

### Intro page template "issues":

It seems like a great template for a custom client site, but this seems like it'd be one of those WTF things trying to explain this one for users in a public-release theme.  Any time you have to explain, "Upload this many images. No don't add them to your content.", it's a support nightmare.

Issues for users:

* The #2 and #3 images are going to be confusing.
* The #2 and #3 images are going to be hard to change after first setting them.
* The `<blockquote>` wrapping the post content is going to cause issues with whatever HTML the user throws into the editor.
* The layout is never going to line up all nice and neat like it's done in `page-template-intro.html` anyway.

My proposal for changes is something like this:

	<!-- featured-image -->
	<img />

	<!-- post content section -->
	<article>
	</article>

Of course, all that's really doing is adding the featured image to the normal page output.  But, it's not confusing to users.