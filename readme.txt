=== WP-MyAnimeList ===
Contributors: KeeperOfLogic
Donate link: http://voiceoflogic.co.il/blog/wp-myanimelist-plugin
Tags: myanimelist.net, myanimelist, anime, feed, manga, mal, widget
Requires at least: 3.0
Tested up to: 3.3
Stable tag: trunk
Version: 1.0
License: GPLv2

A highly customizable widget that display your anime and manga lists from MyAnimeList.net
== Description ==

A highly customizable widget that display your anime and manga lists from [MyAnimeList.net](http://MyAnimeList.net).

**Features**

* Sort the list by any field (in any direction) or randomly
* Control the display by adjusting image width and how many items to show in a row.
* Super flex filtering mechanism allows you to apply filtering on any field, in any combination!
* Caching Support (every hour, day or week) 
* Change the look and feel with custom CSS support
* Different connection methods (Curl or File_get_content) 
* Different caching mechanism (DB or File)


For more information, visit the [plugin homepage](http://voiceoflogic.co.il/blog/wp-myanimelist-plugin). 

== Installation ==

1. Upload 'wp-myanimelist' folder to the '/wp-content/plugins/' directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Go to 'Widgets' menu and drag the 'WP-MyAnimeList' widget into the sidebar.
1. Expand the widget and configure it (default settings should be ok, just change your MAL username).

[View instructions with images](http://voiceoflogic.co.il/blog/wp-myanimelist-plugin).

== Screenshots ==

1. WP-MyAnimeList - Widget Settings
2. WP-MyAnimeList - Widget in Sidebar

== Configuration ==
The only property you must enter is your MAL username. All other properties can be left at default.

**Data Retrieval**
 
* MAL username:  Your MyAnimeList.net username. 
* Connection method: Specify which method to connect to MyAnimeList site. Leave it to default unless your are experiencing a problem. 
* Cache: Using cache will speed up your site performance. Leave it to default unless your are experiencing a problem. For more information look at the FAQ section.

**Sort and Filter**  

* Sort by: Determine how to sort the anime list. For more information look at the FAQ section.
* Sort by direction: Low to high – sort the list in ascending order. High to low – sort the list in descending order.
* Filter expression: This powerful setting allows you to filter the anime list in order to show only specific anime series. For more information look at the FAQ section.

**Appearance**
  
* Widget title: Title of the widget. Leave empty to hide the title. 
* Columns: How many anime items in a row. (default 3)  
* Image width: The anime image width (in pixels). Default 95. A lower number will make the images look smaller, and a higher number will make them look bigger (maximum recommended width is 225px). (default 95) 
* Maximum items:  Maximum number of anime to show. Leave empty to show all. (default 12)  
* Show image: Show the anime image.  
* Show title:  Show the anime title.  
* More link:  Checking this will add a "more" link which points to your MAL list. You can also enter the link text.  
* Widget CSS:  CSS is the web styling rules. Change this to modify how the list is displayed in the site. (advanced users)  

[View instructions with images](http://voiceoflogic.co.il/blog/wp-myanimelist-plugin).

== Frequently Asked Questions ==

= What is cache and why do I need it? =
Cache help to load the page faster by reducing the number of times the plugin fetches data from MyAnimeList site. The way it does that is by temporary saving the data on your site. WP-MyAnimeList Widget allows you to specify when the cache is refreshed and where it is stored.
It is generally recommended to use cache unless it causes a problem.

= What is the difference between different cache methods? =
* In server file: this option will create a file in the plugin folder and store the cached data in there. It requires write permission to that folder. (default) 
* In Wordpress database – this option will save the cached data inside Wordpress options table. Use this if the first option doesn’t work. 
* No cache – This option will cause the plugin to fetch data from MyAnimeList site on every page request, and is not recommended. Use this if the caching causes a problem. 

= When should I update my cache? =
The duration should match your preferences. If you want to show new anime as soon as you add it to your list, than choose every hour. If, on the other hand, you use the plugin to show your highest score anime, than setting it once every week should suffice. 

= What is the different sort fields meanings? =

Series Information

* ID: The ID (unique number) of the anime in MAL site. 
* Title:  Name of the anime. (default)  
* Type:  1 = TV, 2 = OVA, 3 = Movie 
* Episodes: Total number of episodes in the anime 
* Status: Currently Airing=1, Finished Airing=2 
* Start date: When the anime was first aired 
* End date: When the anime finished airing 

My Information

* Watched episodes: how many episodes have you watched 
* Watch start date: When you started watching this anime 
* Watch finish date:  When you Finished watching this anime 
* Score: The score you gave to the anime 
* Watch status: 1 = Watching, 2 = Completed, 3 = On-hold, 4 = Dropped, 6 = Plan to Watch 
* Updated date:  When you last updated the anime details 
* Tags: Your anime tags 
* Random: Sort the anime list randomly. (Note: if you want your visitors to see different anime on each page hit, disable caching) 

= How to sort the list to show my recent anime changes? =
Sort by Updated date with direction High to low. 

= How to sort the list to show my top favorites shows? =
Sort by Score with direction High to low. 

= How to write filter expression? What are the possible fields? =
The filter expression setting allows you to filter the anime list in order to show only specific anime series. You enter an "expression" (statement) and if that expression evaluates to true than the anime is displayed.
The expression is made out from anime field names, comparison methods and Boolean connectors. for example the following expression

(($my_status == 2) && ($my_score >= 5)) (default) 

means "display only anime which I have finished watching and gave score of 5 or more points".
The fields are divided into to groups: the "Series Fields" contain information on the series, while "My Fields" are only relevant to your specific user.

Series Fields Type

* series_animedb_id: Number 
* series_title: String 
* series_synonyms: String 
* series_type: Number (1 = TV, 2 = OVA, 3 = Movie) 
* series_episodes: Number 
* series_status: Number (1 = Currently Airing, 2 = Finished Airing) 
* series_start: Date 
* series_end: Date
 
My Fields Type

* my_watched_episodes: Number 
* my_start_date: Date 
* my_finish_date: Date 
* my_score: Number 
* my_status:  Number (1 = Watching, 2 = Completed, 3 = On-hold, 4 = Dropped, 6 = Plan to Watch) 
* my_last_updated: Date 
* my_tags: String 
* my_rewatching: Number 
* my_rewatching_ep: Number 


== Changelog ==

= 1.0.0 =
* Initial Release.