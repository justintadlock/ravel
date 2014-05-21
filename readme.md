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